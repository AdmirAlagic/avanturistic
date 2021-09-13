/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 22);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/activity.js":
/*!**********************************!*\
  !*** ./resources/js/activity.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

//map
var isMobile = true; //initiate as false

var sortBy = 'date';
var scrollTop, scrollLeft;
is_mobile = true;
var map;
var page = 1;
var center = {
  lat: 44.063545,
  lng: 17.936309
};
var activeFilters = [];
var baseUrl = window.pageHostname;
var loading = false;
var loadedAll = false;
var markers;
var locationChanged = false;
var fullscreenEntered = false;
var interleaveOffset = 0.7;
var lastScrollY;
var scheduledAnimationFrame = false;
var addedMarkers;
var $grid;
var mainActivity;
var lastActiveFilter = null;
var layoutStyle = 'details';
swiperOptions = {
  loop: true,
  speed: 500,
  effect: 'fade',
  grabCursor: false,
  preloadImages: false,
  lazy: {
    loadOnTransitionStart: true,
    loadPrevNextAmount: 2,
    loadPrevNext: true
  },
  mousewheelControl: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: true
  },
  pagination: {
    el: '.swiper-pagination'
  },
  keyboardControl: true
};
var DOMContentLoaded_event = document.createEvent("Event");
DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true);

function getMorePosts(_lat, _lng) {
  loading = true;
  var morePostData = {
    radius: 53000,
    page: page,
    lat: _lat,
    lng: _lng,
    filters: activeFilters,
    sort: sortBy
  }; // $('.loading-spinner-posts').show();

  $.ajax({
    url: '/getPostsByLocation',
    method: 'GET',
    dataType: 'html',
    data: morePostData,
    success: function success(html) {
      page = page + 1;
      $('.refresh-loc-icon').show();
      $('.loading-spinner-loc').hide();

      if (html == 'false') {
        $('.loading-spinner-posts').hide();
        $('#scrollForMore').hide();
        loading = false;
        loadedAll = true;
        return;
      }

      loading = false;
      $('#more-posts').append(html);
      $('.loading-spinner-posts').hide();
      if ($('#more-posts .my-post').length > 4 || $('#more-posts .my-post').length < 4) $('#scrollForMore').hide();
      $(window).resize();
      $('[data-toggle="kt-tooltip"]').tooltip();
      loading = false;
      scheduledAnimationFrame = false; //

      loadSwiper();
      DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true);
      window.document.dispatchEvent(DOMContentLoaded_event);
    }
  });
}

function getItems(posts) {
  var items = '';
  $.each(posts, function (key, val) {
    val.image = JSON.parse(val.image);

    if (val.image) {
      if (val.image[0].thumb_path) {
        items += getItem(val.id, val.slug, val.image[0].thumb_path, val.distance, val.video);
      }
    }
  });
  return $(items);
}

$.fn.masonryImagesReveal = function ($items) {
  var msnry = this.data('masonry');
  var itemSelector = msnry.options.itemSelector; // hide by default

  $items.hide(); // append to container

  this.append($items);
  $items.imagesLoaded().progress(function (imgLoad, image) {
    // get item
    // image is imagesLoaded class, not <img>, <img> is image.img
    var $item = $(image.img).parents(itemSelector); // un-hide item

    $item.show(); // masonry does its thing

    msnry.appended($item);
  });
  return this;
};

var videoHtml = '<span style="position:absolute;left:10px;top:10px;color:#FFFFFF;"><i class="fa fa-play" style=";font-size:1.3rem;"></i></span>';

function getItem(id, slug, src, distance, video) {
  videoIcon = '';

  if (video && video != ' ' && video != '') {
    videoIcon = videoHtml;
  }

  var item = '<div class="adventure-grid-item" style="position: relative;">' + '<a class="loading" href="/adventure/' + id + '/' + slug + '?s=' + sortBy + '&a=' + mainActivity + '"><img style="border:1px solid #ffffff;" src="' + src + '" /><div  style="padding:3px;font-size:0.9rem;background: rgba(0,0,0,0.4);color:#FFFFFF;position:absolute;bottom: 1px;left:1px;right:1px;"> <i  class="fa fa-location-arrow text-white"></i><br>' + parseFloat(distance).toFixed(2) + ' km</div>' + videoIcon + '</a></div>';
  return item;
}

function loadSwiper() {
  $('#more-posts .swiper-container.inactive').each(function (index) {
    $this = $(this);
    $this.addClass('active');
    $this.removeClass('inactive');
    var swiper = new Swiper("#" + $this.attr('id'), swiperOptions);
  });
}

$(document).ready(function () {
  mainActivity = $('#activity').data('key');
  activeFilters.push(mainActivity);

  function getLocation() {
    if (navigator.geolocation) {
      $('.refresh-loc-icon').hide();
      $('.loading-spinner-loc').show();
      navigator.geolocation.getCurrentPosition( // Success callback
      function (position) {
        var lat, lng;
        lat = position.coords.latitude;
        lng = position.coords.longitude;

        if (lat && lng) {
          $.ajax({
            url: '/setUserLocation',
            method: 'POST',
            dataType: 'json',
            data: {
              lat: lat,
              lng: lng
            },
            success: function success(data) {
              page = 1;
              resetLayoutStyle(layoutStyle);
            }
          });
        }
      }, // Optional error callback
      function (error) {
        var message;

        if (isMobile) {
          message = 'To use precise location, <b>enable location services</b>, click "<b>Update Location</b>" and <b>turn off</b> location services to <b>save battery</b>.';
        } else {
          message = 'To use precise location <b>enable location services</b> and click "<b>Update Location</b>".<br> After refreshing you can <b>turn off</b> location services ';
        }

        swal.fire({
          title: 'Location services disabled',
          html: message,
          type: 'warning',
          confirmButtonText: 'Got it.'
        });
        loading = false;
        $('.refresh-loc-icon').show();
        $('.loading-spinner-loc').hide();
        $(window).resize();
      });
    }
  }

  addedMarkers = L.layerGroup();
  $('#more-posts, #more-posts-activity').on('click', '.likeBtn', function (e) {
    e.preventDefault();
    var $this = $(this);
    var post_id = $(this).data('post_id');
    var icon = $(this).find('i');

    if (!icon.hasClass('text-success')) {
      icon.removeClass('text-white');
      icon.addClass('text-success');
    } else {
      icon.removeClass('text-success');
      icon.addClass('text-white');
    }

    $.ajax({
      url: '/post/like',
      method: "POST",
      data: {
        'post_id': post_id
      },
      success: function success(data) {
        if (data !== 'login') {
          $this.find('.likesCount').html('&nbsp;' + data + '&nbsp;');
          $this.attr('disable', true);
        } else {
          swal.fire({
            title: 'Only for members',
            text: 'Log in to like adventures',
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'OK'
          }).then(function (result) {
            if (result.dismiss != 'cancel') window.location = 'https://avanturistic.com/login';
          });
        }
      }
    });
  });
  $('#more-posts, #more-posts-activity').on('click', '.visitedBtn', function (e) {
    e.preventDefault();
    var $this = $(this);
    var post_id = $(this).data('post_id');
    $this.addClass('text-success');
    var icon = $(this).find('i');

    if (!icon.hasClass('text-success')) {
      icon.removeClass('text-white');
      icon.addClass('text-success');
    } else {
      $this.tooltip('hide');
      icon.removeClass('text-success');
      icon.addClass('text-white');
      icon.parent().parent().trigger('click');
    }

    $.ajax({
      url: '/post/visited',
      method: "POST",
      data: {
        'post_id': post_id
      },
      success: function success(data) {
        if (data !== 'login') {
          $this.find('.visitedsCount').html('&nbsp;' + data + '&nbsp;');
          $this.attr('disable', true);
        } else {
          swal.fire({
            title: 'Only for members',
            text: 'Log in to set "I was here"',
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'OK'
          }).then(function (result) {
            if (result.dismiss != 'cancel') window.location = 'https://avanturistic.com/login';
          });
        }
      }
    });
  });
  $(document).on('click', '.aquireLocation', function (e) {
    e.preventDefault();
    loadedAll = false;
    getLocation();
  });
  $(document).on('click', '.sortBy', function (e) {
    e.preventDefault();
    $this = $(this);
    sortBy = $(this).data('sort');
    $('.category-sort').html($(this).find('span').html());
    page = 1;
    loadedAll = false;
    $('.sortBy').removeClass('active');
    $this.addClass('active');
    $this.parent().parent().removeClass('show');
    $('#more-posts').html('<div class="text-center loading-spinner-posts">\n' + '                                <br>\n' + '                                <span class="kt-spinner kt-spinner--sm kt-spinner--primary"> </span>\n' + '                            </div>');
    page = 1;

    if ($grid) {
      $grid.masonry('remove', $grid.masonry('getItemElements'));
      $grid.masonry('layout');
      reloadMasonry();
      getMorePostsMasonry();
    } else {
      getMorePosts();
    }
  });
  $(document).on('click', '.layoutStyle', function (e) {
    e.preventDefault();
    $this = $(this);
    layoutStyle = $(this).data('sort');
    $('.category-style').html($(this).find('span').html());
    page = 1;
    loadedAll = false;
    $('.layoutStyle').removeClass('active');
    $this.addClass('active');
    page = 1;
    resetLayoutStyle(layoutStyle);
    $this.parent().parent().removeClass('show');
  });

  function resetLayoutStyle(layoutStyle) {
    $('#scrollForMore').show();

    if (layoutStyle === 'simple') {
      if (!$grid) {
        initMasonry();
      } // reloadMasonry();

    } else {
      if ($grid) {
        $grid.masonry('remove', $grid.masonry('getItemElements'));
        $grid.masonry('layout');
        $grid = null;
      }

      $('#more-posts').html('<div class="text-center loading-spinner-posts">\n' + '                                <br>\n' + '                                <span class="kt-spinner kt-spinner--sm kt-spinner--primary"> </span>\n' + '                            </div>');
      getMorePosts();
    }
  }

  window.document.dispatchEvent(DOMContentLoaded_event);
  loadSwiper();

  function reloadMasonry() {
    $grid = $('.adventures-masonry-grid').masonry({
      itemSelector: '.adventure-grid-item',
      percentPosition: true,
      columnWidth: '.adventure-grid-sizer'
    });
    return $grid;
  }

  function initMasonry() {
    $('#more-posts').html('');
    $grid = reloadMasonry(); // layout Masonry after each image loads

    $grid.imagesLoaded().progress(function () {
      $grid.masonry();
    }); // layout Masonry after each image loads

    $grid.imagesLoaded().progress(function () {
      $grid.masonry('layout');
    });
    getMorePostsMasonry();
  }

  function getMorePostsMasonry(_lat, _lng) {
    loading = true;
    var morePostData = {
      radius: 53000,
      page: page,
      filters: activeFilters,
      sort: sortBy
    };

    if (_lat && _lng) {
      morePostData.lat = _lat;
      morePostData.lng = _lng;
    } // $('.loading-spinner-posts').show();


    $.ajax({
      url: '/getPostsByLocationData',
      method: 'GET',
      data: morePostData,
      success: function success(data) {
        page = page + 1;
        $('.refresh-loc-icon').show();
        $('.loading-spinner-loc').hide(); //Masonry

        var $items = getItems(data.posts);
        console.log(data.posts);
        $grid.masonryImagesReveal($items);
        $('.loading-spinner-posts').hide();
        if ($('#more-posts .my-post').length > 4 || $('#more-posts .my-post').length < 4) $('#scrollForMore').hide();
        $(window).resize();
        $('[data-toggle="kt-tooltip"]').tooltip();
        loading = false;
        scheduledAnimationFrame = false; //

        loadSwiper();
        DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true);
        window.document.dispatchEvent(DOMContentLoaded_event);
      }
    });
  }

  function readAndUpdatePage() {
    var element;
    var offset = 100;

    if (layoutStyle == 'simple') {
      element = $('#adventures-grid');
      offset = 180;
    } else {
      element = $('#more-posts');
    }

    if (lastScrollY + $(window).height() + offset >= element.height()) {
      if (loading == false && loadedAll == false) {
        loading = true;
        $('.more-posts-loader').show();

        if (layoutStyle === 'simple') {
          getMorePostsMasonry();
        } else {
          getMorePosts(page);
        }

        scheduledAnimationFrame = true;
      }
    } else {
      scheduledAnimationFrame = false;
    }
  }

  function onScroll(evt) {
    // Store the scroll value for laterz.
    lastScrollY = window.scrollY; // Prevent multiple rAF callbacks.

    if (scheduledAnimationFrame) return;
    scheduledAnimationFrame = true;
    requestAnimationFrame(readAndUpdatePage);
  }

  window.addEventListener('scroll', onScroll, {
    passive: true
  });
  getMorePosts(); // getMorePostsMasonry();
});

/***/ }),

/***/ 22:
/*!****************************************!*\
  !*** multi ./resources/js/activity.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/braco/Sites/avanturistic/resources/js/activity.js */"./resources/js/activity.js");


/***/ })

/******/ });