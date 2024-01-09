var DZ
var  childDropzoneArr = [];
jQuery(document).ready(function($) {

	$(document).on('change', 'input[name="tax_city"], input[name="city"]', function(){
		const this_ = $(this);
		$('ul#districts').empty();
		$('#current_district').text('Район');
		$('ul#districts').not('.not_all').append(`<li class="option selected focus"><label for="select-3-0"></label><input type="radio" name="district" id="select-3-0" value="" checked>Всі</li>`);
		let counter = 0;
		$.each(php_vars.cities, function(index, value){
			if(this_.val() == value.parent){
				//const li_class = counter == 0 ? ' selected focus' : '';
				//const checked = counter == 0 ? ' checked' : '';
				$('ul#districts').append(`<li class="option"><label for="select-3-${index + 1}"></label><input type="radio" name="district" id="select-3-${index + 1}" value="${value.term_id}">${value.name}</li>`);
				counter++;
			}
		});
	})

	$(document).on('change', 'input[name="region"], input[name="region_filter"]', function(){

		let data = {
			'action': 'get_builders',
			'region': $(this).attr('name') == 'region_filter' ? $(this).attr('region_name') : $(this).val(),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					let builders = JSON.parse(data.slice(0, -1));
					$('ul#get_builders').empty();
					let counter = 0;
					$.each(builders, function(index, value){
						$('ul#get_builders').append(`<li class="option"><label for="builder-${index + 1}"></label><input type="radio" name="meta_builder" id="builder-${index + 1}" value="${value.ID}">${value.post_title}</li>`);
						counter++;
					});
				} else {
					console.log('Error!');
				}
			},
		});

		return false;

	})

	$(document).on('change', 'input[name="meta_builder"]', function(){

		let data = {
			'action': 'get_complexes',
			'builder': $(this).val(),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					let complexes = JSON.parse(data.slice(0, -1));
					$('ul#get_complexes').empty();
					let counter = 0;
					$.each(complexes, function(index, value){
						$('ul#get_complexes').append(`<li class="option"><label for="complex-${index + 1}"></label><input type="radio" name="meta_complex" id="complex-${index + 1}" value="${value.ID}">${value.post_title}</li>`);
						counter++;
					});
				} else {
					console.log('Error!');
				}
			},
		});

		return false;

	})

	$(document).on('change', 'input[name="meta_complex"]', function(){

		let data = {
			'action': 'get_turns',
			'complex': $(this).val(),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					let turns = JSON.parse(data.slice(0, -1));
					$('ul#get_turns').empty();
					let counter = 0;
					$.each(turns, function(index, value){
						$('ul#get_turns').append(`<li class="option"><label for="turn-${index + 1}"></label><input type="radio" name="tax_turn" id="turn-${index + 1}" value="${value.term_id}">${value.name}</li>`);
						counter++;
					});
				} else {
					console.log('Error!');
				}
			},
		});

		return false;

	})

	$(document).on('change', 'input[name="meta_complex"]', function(){

		let data = {
			'action': 'get_sections',
			'complex': $(this).val(),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					let sections = JSON.parse(data.slice(0, -1));
					$('ul#get_sections').empty();
					let counter = 0;
					$.each(sections, function(index, value){
						$('ul#get_sections').append(`<li class="option"><label for="section-${index + 1}"></label><input type="radio" name="tax_section" id="section-${index + 1}" value="${value.term_id}">${value.name}</li>`);
						counter++;
					});
				} else {
					console.log('Error!');
				}
			},
		});

		return false;

	})


	$(document).on('change', 'input[name="region"]', function(){

		let data = {
			'action': 'cities_from_db',
			'region_id': $(this).attr('region_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					let cities = JSON.parse(data.slice(0, -1));
					cities = cities.map(function (city) {
						return city.name
					})
					$('input[name="city"]').autocomplete({
						source: cities,
					});
				} else {
					console.log('Error!');
				}
			},
		});

		return false;
	})


	$(document).on('change', 'input[name="region_filter"]', function(){

		let data = {
			'action': 'cities_for_filter',
			'region_id': $(this).val(),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					let cities = JSON.parse(data.slice(0, -1));
					typeof(cities);
					cities = cities.map(function (city) {
						return city.name
					})
					$('input[name="city"]').autocomplete({
						source: cities,
					});
				} else {
					console.log('Error!');
				}
			},
		});

		return false;
	})


	function filter_objects() {
		const filter = $("#filter_objects");
		var url = filter.attr("action");
		var query = filter.attr("action");
		newurl = query;
		query = filter.serialize();
		newurl = url + "?" + query;
		window.history.pushState({ path: url }, "?", newurl);

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: filter.serialize(),
			type: filter.attr("method"),
			beforeSend: function (xhr) {},
			success: function (data) {
				$("#response_objects").html(data);
				$('.pagination-wrap').hide();
				$('.item-home .text-info').Cuttr({
					truncate: 'words',
					length: 25
				});
			},
		});
		return false;
	}


	$(document).on('change', '#sort input[type=radio]', function(e){
		$('input[name=sort]').val($(this).val());
		filter_objects();
	});

	$(document).on('submit', '#filter_objects', function(e){
		e.preventDefault();
		filter_objects();
	});

	/*$(document).on('click', '#filter_objects_reset', function(e){
		e.preventDefault();
		$('#filter_objects').trigger("reset");
	});*/


	function add_object() {

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: $("#add_object").serialize(),
			type: 'POST',
			success: function (data) {
				if (data) {
					function go_to_object(){
						window.location.href = data
					}
					Swal.fire({
						position: "top-center",
						icon: "success",
						title: "Збережено",
						showConfirmButton: false,
					});
					setTimeout(go_to_object, 2000);
				} else {
					/*$('.input-submit.flex').before("<p class='info-show'>Потрібно додати не менше 5 зображень!</p>");*/
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "Потрібно додати не менше 5 зображень!",
					});
				}
			},
		});
		return false;
	}

	$(document).on('submit', '#add_object', function(e){
		e.preventDefault();
		add_object();
	});

	$(document).on('click', '#add_object_draft', function(e){
		e.preventDefault();
		if($('#add_object').valid()){
			$('input[name=draft]').val(true);
			add_object();
		}
	});


	function edit_object() {

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: $("#edit_object").serialize(),
			type: 'POST',
			success: function (data) {
				if (data) {
					function go_to_object(){
						window.location.href = data
					}
					Swal.fire({
						position: "top-center",
						icon: "success",
						title: "Збережено",
						showConfirmButton: false,
					});
					setTimeout(go_to_object, 2000);
				} else {
					/*$('.input-submit.flex').before("<p class='info-show'>Потрібно додати не менше 5 зображень!</p>");*/
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "Потрібно додати не менше 5 зображень!",
					});
				}
			},
		});
		return false;
	}

	$(document).on('submit', '#edit_object', function(e){
		e.preventDefault();
		edit_object();
	});

	$(document).on('click', '#edit_object_draft', function(e){
		e.preventDefault();
		if($('#edit_object').valid()){
			$('input[name=draft]').val(true);
			edit_object();
		}
	});


	$(document).on('click', '.object_to_draft', function(e){
		e.preventDefault();

		let data = {
			'action': 'object_to_draft',
			'object_id': $(this).closest('.send-block').attr('object_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					location.reload();
				} else {
					console.log('Error!');
				}
			},
		});

		return false;

	});


	$(document).on('click', '.object_to_publish', function(e){
		e.preventDefault();

		let data = {
			'action': 'object_to_publish',
			'object_id': $(this).closest('.send-block').attr('object_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					location.reload();
				} else {
					console.log('Error!');
				}
			},
		});

		return false;

	});


	function form_sold() {

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: $("#form_sold").serialize(),
			type: 'POST',
			success: function (data) {
				if (data) {
					window.location.href = data;
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	}

	$(document).on('submit', '#form_sold', function(e){
		e.preventDefault();
		form_sold();
	});


	function create_selection_for_client() {

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: $("#create_selection_for_client").serialize(),
			type: 'POST',
			success: function (data) {
				if (data) {
					window.location.href = data;
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	}

	$(document).on('submit', '#create_selection_for_client', function(e){
		e.preventDefault();
		create_selection_for_client();
	});


	function create_selection() {

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: $("#form_create_selection").serialize(),
			type: 'POST',
			success: function (data) {
				if (data) {
					window.location.href = data;
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	}

	$(document).on('submit', '#form_create_selection', function(e){
		e.preventDefault();
		create_selection();
	});


	$(document).on('click', '.delete_object_from_selection', function(e){
		e.preventDefault();

		let data = {
			'action': 'delete_object_from_selection',
			'object_id': $(this).attr('object_id'),
			'selection_id': $(this).attr('selection_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					location.reload();
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	});


	$(document).on('click', '.delete_object_from_favourite', function(e){
		e.preventDefault();

		let data = {
			'action': 'delete_object_from_favourite',
			'object_id': $(this).closest('.send-block').attr('object_id'),
			'current_user_id': $(this).closest('.send-block').attr('current_user_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					location.reload();
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	});


	$(document).on('click', '.delete_object', function(e){
		e.preventDefault();

		let data = {
			'action': 'delete_object',
			'object_id': $(this).closest('.send-block').attr('object_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					Swal.fire({
						title: "Ви впевнені що хочете видалити цей об'єкт?",
						/*text: "Ви не зможете скасувати це!",*/
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						confirmButtonText: "Так",
						cancelButtonText: "Ні",
					}).then((result) => {
						if (result.isConfirmed) {
							Swal.fire({
								title: "Видалено!",
								text: "Ваш об'єкт видалено",
								icon: "success",
								showConfirmButton: false,
							});
							window.location.href = data;
						}
					});
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	});


	$(document).on('click', '.delete_selection', function(e){
		e.preventDefault();

		let data = {
			'action': 'delete_selection',
			'selection_id': $(this).closest('.item-user').attr('selection_id') ? $(this).closest('.item-user').attr('selection_id') : $(this).closest('.item-photo').attr('selection_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					location.reload();
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	});


	$(document).on('click', '.like-item a', function(e){
		e.preventDefault();
		let _this = $(this);

		let data = {
			'action': 'add_to_favourite',
			'object_id': _this.attr('object_id'),
			'current_user_id': _this.attr('current_user_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					_this.closest('.like-item').toggleClass('is-like');
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	});


	$(document).on('click', '.add_object_to_selection a', function(e){
		e.preventDefault();
		let _this = $(this);

		let data = {
			'action': 'add_object_to_selection',
			'object_id': _this.closest('.item-photo').attr('object_id'),
			'selection_id': _this.closest('.item-photo').attr('selection_id'),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					_this.closest('.add_object_to_selection').toggleClass('is_added');
					if(_this.closest('.add_object_to_selection').hasClass('is_added')) $(_this).closest('.item-photo').prepend("<p class='info-show'>Об’єкт успішно додано у підбір</p>");
					else $(_this).closest('.item-photo').prepend("<p class='info-show'>Об’єкт успішно видалено з підбору</p>");
					setTimeout(function() {
						$('.item-home .info-show').remove();
					}, 1300);

					location.reload();
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	});


	function edit_user_phone() {

		let data = {
			'action': 'edit_user_phone',
			'current_user_id': $('.edit_user_phone').attr('current_user_id'),
			'current_user_phone': $('input[name="user-tel"]').val(),
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					//window.location.href = data;
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	}

	$(document).on('click', '.edit_user_phone', function (e){
		e.preventDefault();
		$(this).toggleClass('is-active');
		if($(this).hasClass('is-active')){
			$(this).closest('.text-wrap').find('input').prop("disabled",false);
		}else{
			edit_user_phone();
			$(this).closest('.text-wrap').find('input').prop("disabled",true);
		}

	});

	$(document).on('input', '#user-tel', function(e){
		e.preventDefault();
		edit_user_phone();
	});


	/*$(document).on('click', '.hide_object', function(e){
		e.preventDefault();
		$(this).closest('.item-home').remove();
	});*/


	if ($('.loginform').length)
		$('.loginform').validate({
			errorPlacement: function(error, element) {
				var placement = $(element).data('error');
				var pl = $(element).closest('div')
				error.prependTo(pl);
			},

			submitHandler: function (form) {
				var data = $('.loginform').serialize()
				$.ajax({
					url: '/wp-admin/admin-ajax.php',
					data: data,
					type: 'POST',
					dataType: 'json',
					success: function (data) {
						if (data) {
							console.log(data)

							$('.result-login').html(data.status)

							if (data.update)
								location.href = data.redirect
						}
					}
				});
			}
		});



	function addChildDropzone() {


		var url = '/wp-admin/admin-ajax.php' + '?action=dropzonejs_upload';

		if ($('#upload_user_avatar').length)
			var url = '/wp-admin/admin-ajax.php' + '?action=dropzonejs_upload&user_id=' + user_id;

		$("#dZUpload").dropzone({

			url: url,
			maxFiles: $('#upload_user_avatar').length  ? 1 : 1000,

     // autoProcessQueue: false ,
			thumbnailWidth: 640,
			thumbnailHeight: 640,
			acceptedFiles: 'image/*',
			previewTemplate: "<figure><img data-dz-thumbnail /> <a data-id=''  href='#'>x</a> </figure>",
			init: function() {

				DZ = this
				var container = $(this.element);


				this.on("sending", function(files, xhr, formData) {
					container.addClass("loading");
					$(".loading-dz").show();
					$('.input-submit button').prop('disabled', true)
				});

				this.on("complete", function(file, data) {

					$('#dZUpload figure.dz-image-preview').each(function(l){
						var id = childDropzoneArr[l];
						$(this).find('a').attr('data-id', id);
						$('.input-submit button').prop('disabled', false)
						console.log(id)
					})
					$('[name="images"]').val(childDropzoneArr.join(','));

				});


				this.on("success", function(file, data) {
					childDropzoneArr.push(data);
					$(".loading-dz").hide();

				});

			},


		});
	}
	addChildDropzone();

	$(document).on('click', '.dz-image-preview a', function(e){
		e.preventDefault()
		var id = $(this).attr('data-id');
		console.log(id)
		console.log(childDropzoneArr)
		var index = childDropzoneArr.indexOf(id);
		if (index > -1) { // only splice array when item is found
			childDropzoneArr.splice(index, 1); // 2nd parameter means remove one item only
		}

		function onlyUnique(value, index, array) {
			return array.indexOf(value) === index;
		}


		$(this).parent().remove();


		$('#dZUpload figure.dz-image-preview').each(function(){
			var id = $(this).find('a').attr('data-id');
			childDropzoneArr.push(id);

		})

		childDropzoneArr = childDropzoneArr.filter(onlyUnique);

		$('[name="images"]').val(childDropzoneArr.join(','))

		$.ajax({
			url: '/wp-admin/admin-ajax.php',
			data: {
				action : 'delete_attachment' ,
				id: id
			},
			type: 'POST',
			dataType: 'json',
			success: function (data) {
				if (data) {
					console.log(data)

				}
			}
		});
	})


	$("#dZUpload").sortable({
		items:'.dz-image-preview',
		cursor: 'move',
		opacity: 0.5,
		containment: '#dZUpload',
		distance: 20,
		tolerance: 'pointer',
		stop: function () {
			childDropzoneArr = [];
			$('#dZUpload figure.dz-image-preview').each(function(){

				var id = $(this).find('a').attr('data-id');
				childDropzoneArr.push(id);
			})
			console.log(childDropzoneArr)
			$('[name="images"]').val(childDropzoneArr.join(','));

		}
	});


	$(document).on('click', 'nav.top-menu-lading li.region, nav.mob-menu-land li.region', function(e){
		e.preventDefault();
		let _this = $(this);
		let region_name = '';
		let region_id = _this.attr('region_id');

		let data = {
			'action': 'select_region',
			'region_id': region_id,
		}

		switch (data.region_id) {
		case '166':
			region_name = 'Києві';
			break;
		case '131':
			region_name = 'Івано-Франківську';
			break;
		case '93':
			region_name = 'Дніпрі';
			break;
		case '135':
			region_name = 'Львові';
			break;

		default:
			break;
		}

		$.ajax({
			url: "/wp-admin/admin-ajax.php",
			data: data,
			type: 'POST',
			success: function (data) {
				if (data) {
					$('.home-block.home-block-default.bg-white .title h2 span').text(region_name);
					if($('.pagination-wrap').length > 0) $('.pagination-wrap').empty();
					if($('.to_catalog, li.li_to_catalog a').length > 0) $('.to_catalog, li.li_to_catalog a').attr('href', '/catalog/?region_id=' + region_id);
					if($('#objects').length > 0) $('#objects').css('display', 'block');
					$("#response_objects").html(data);
					$('.item-home .text-info').Cuttr({
						truncate: 'words',
						length: 25
					});
					$('.item-home .text-wrap .btn-dot .object_region, .inner-home-block .link-map-wrap .object_region').Cuttr({
						truncate: 'characters',
						length: 22
					});
				} else {
					console.log('Error!');
				}
			},
		});
		return false;
	});

});

let button = document.getElementById("application_submit");
let code = document.getElementsByClassName("iti__selected-dial-code");
let hiddenField = document.getElementById("phone_code");
if (button) {
	button.onclick = function(){
		hiddenField.value = code[0].innerText;
	};
}
