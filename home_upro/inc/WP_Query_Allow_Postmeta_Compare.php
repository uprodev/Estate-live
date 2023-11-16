<?php 
/**
 * Allowes to use `meta_query` parameter item key as `value`
 * parameter in another `meta_query` item for compare meta
 * values between each other.
 *
 * Example:
 *
 *     'meta_query' => [
 *         'relation' => 'AND',
 *         'room_floor.value' => [
 *             'key'     => 'room_floor',
 *             'value'   => 1,
 *             'compare' => '!=',
 *             'type'    => 'NUMERIC',
 *         ],
 *         [
 *             'key'     => 'room_floor_max',
 *             'compare' => '!=',
 *             'value'   => 'room_floor.value',
 *             'type'    => 'NUMERIC',
 *         ],
 *     ],
 *
 *     // in this example we specified `room_floor.value` key
 *     // and then use it as `value` for another item.
 *
 * @requires PHP 7.0
 */
final class WP_Query_Allow_Postmeta_Compare {

	public static function init(){

		add_filter( 'posts_clauses', [ __CLASS__, '_meta_value_replacer' ], 20, 2 );

		//add_filter( 'posts_request', [ __CLASS__, 'debug_die_request' ], 999 );
	}

	public static function _meta_value_replacer( $clauses, $wp_query ){

		/** @var WP_Meta_Query $mq */
		$mq = $wp_query->meta_query;

		if( ! $mq ){
			return $clauses;
		}

		$mq_clauses = $mq->get_clauses() ?: [];

		$replace = [];

		foreach( $mq_clauses as $key => $clause ){

			if( $clause['key'] === $key ){
				trigger_error( "`Meta clause key` can not be the same as value parameter. The key: $key" );
				continue;
			}

			$value = $clause['value'] ?? '';
			$the_clause = $mq_clauses[ $value ] ?? [];

			if( ! $the_clause ){
				continue;
			}

			$from = "'$value'";

			if( 'CHAR' === $the_clause['cast'] ){
				$to = sprintf( '%s.meta_value', $the_clause['alias'] );
			}
			else {
				$to = sprintf( 'CAST( %s.meta_value AS %s )', $the_clause['alias'], $the_clause['cast'] );
			}

			$replace[ $from ] = $to;
		}

		foreach( $replace as $from => $to ){
			$clauses['where'] = str_replace( $from, $to, $clauses['where'] );
		}

		return $clauses;
	}

	public static function debug_die_request( $sql ){
		die( $sql );
	}

}