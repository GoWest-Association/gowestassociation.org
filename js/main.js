function forceDownload(e,n){var t=new XMLHttpRequest;t.open("GET",e,!0),t.responseType="blob",t.onload=function(){var e=(window.URL||window.webkitURL).createObjectURL(this.response),t=document.createElement("a");t.href=e,t.download=n,document.body.appendChild(t),t.click(),document.body.removeChild(t)},t.send()}!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?e(require("jquery")):e(window.jQuery||window.Zepto)}(function(c){function e(){}function u(e,t){f.ev.on(C+e+x,t)}function d(e,t,n,a){var o=document.createElement("div");return o.className="mfp-"+e,n&&(o.innerHTML=n),a?t&&t.appendChild(o):(o=c(o),t&&o.appendTo(t)),o}function p(e,t){f.ev.triggerHandler(C+e,t),f.st.callbacks&&(e=e.charAt(0).toLowerCase()+e.slice(1),f.st.callbacks[e]&&f.st.callbacks[e].apply(f,c.isArray(t)?t:[t]))}function m(e){return e===A&&f.currTemplate.closeBtn||(f.currTemplate.closeBtn=c(f.st.closeMarkup.replace("%title%",f.st.tClose)),A=e),f.currTemplate.closeBtn}function i(){c.magnificPopup.instance||((f=new e).init(),c.magnificPopup.instance=f)}function r(){y&&(v.after(y.addClass(l)).detach(),y=null)}function o(){n&&c(document.body).removeClass(n)}function t(){o(),f.req&&f.req.abort()}var f,a,g,s,h,A,l,v,y,n,_="Close",H="BeforeClose",b="MarkupParse",w="Open",j="Change",C="mfp",x="."+C,I="mfp-ready",R="mfp-removing",k="mfp-prevent-close",T=!!window.jQuery,P=c(window),S=(c.magnificPopup={instance:null,proto:e.prototype={constructor:e,init:function(){var e=navigator.appVersion;f.isLowIE=f.isIE8=document.all&&!document.addEventListener,f.isAndroid=/android/gi.test(e),f.isIOS=/iphone|ipad|ipod/gi.test(e),f.supportsTransition=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1}(),f.probablyMobile=f.isAndroid||f.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),g=c(document),f.popupsCache={}},open:function(e){if(!1===e.isObj){f.items=e.items.toArray(),f.index=0;for(var t,n=e.items,a=0;a<n.length;a++)if((t=(t=n[a]).parsed?t.el[0]:t)===e.el[0]){f.index=a;break}}else f.items=c.isArray(e.items)?e.items:[e.items],f.index=e.index||0;if(!f.isOpen){f.types=[],h="",e.mainEl&&e.mainEl.length?f.ev=e.mainEl.eq(0):f.ev=g,e.key?(f.popupsCache[e.key]||(f.popupsCache[e.key]={}),f.currTemplate=f.popupsCache[e.key]):f.currTemplate={},f.st=c.extend(!0,{},c.magnificPopup.defaults,e),f.fixedContentPos="auto"===f.st.fixedContentPos?!f.probablyMobile:f.st.fixedContentPos,f.st.modal&&(f.st.closeOnContentClick=!1,f.st.closeOnBgClick=!1,f.st.showCloseBtn=!1,f.st.enableEscapeKey=!1),f.bgOverlay||(f.bgOverlay=d("bg").on("click"+x,function(){f.close()}),f.wrap=d("wrap").attr("tabindex",-1).on("click"+x,function(e){f._checkIfClose(e.target)&&f.close()}),f.container=d("container",f.wrap)),f.contentContainer=d("content"),f.st.preloader&&(f.preloader=d("preloader",f.container,f.st.tLoading));var o=c.magnificPopup.modules;for(a=0;a<o.length;a++){var i=(i=o[a]).charAt(0).toUpperCase()+i.slice(1);f["init"+i].call(f)}p("BeforeOpen"),f.st.showCloseBtn&&(f.st.closeBtnInside?(u(b,function(e,t,n,a){n.close_replaceWith=m(a.type)}),h+=" mfp-close-btn-in"):f.wrap.append(m())),f.st.alignTop&&(h+=" mfp-align-top"),f.fixedContentPos?f.wrap.css({overflow:f.st.overflowY,overflowX:"hidden",overflowY:f.st.overflowY}):f.wrap.css({top:P.scrollTop(),position:"absolute"}),!1!==f.st.fixedBgPos&&("auto"!==f.st.fixedBgPos||f.fixedContentPos)||f.bgOverlay.css({height:g.height(),position:"absolute"}),f.st.enableEscapeKey&&g.on("keyup"+x,function(e){27===e.keyCode&&f.close()}),P.on("resize"+x,function(){f.updateSize()}),f.st.closeOnContentClick||(h+=" mfp-auto-cursor"),h&&f.wrap.addClass(h);var r=f.wH=P.height(),s={},l=(f.fixedContentPos&&f._hasScrollBar(r)&&(l=f._getScrollbarSize())&&(s.marginRight=l),f.fixedContentPos&&(f.isIE7?c("body, html").css("overflow","hidden"):s.overflow="hidden"),f.st.mainClass);return f.isIE7&&(l+=" mfp-ie7"),l&&f._addClassToMFP(l),f.updateItemHTML(),p("BuildControls"),c("html").css(s),f.bgOverlay.add(f.wrap).prependTo(f.st.prependTo||c(document.body)),f._lastFocusedEl=document.activeElement,setTimeout(function(){f.content?(f._addClassToMFP(I),f._setFocus()):f.bgOverlay.addClass(I),g.on("focusin"+x,f._onFocusIn)},16),f.isOpen=!0,f.updateSize(r),p(w),e}f.updateItemHTML()},close:function(){f.isOpen&&(p(H),f.isOpen=!1,f.st.removalDelay&&!f.isLowIE&&f.supportsTransition?(f._addClassToMFP(R),setTimeout(function(){f._close()},f.st.removalDelay)):f._close())},_close:function(){p(_);var e=R+" "+I+" ";f.bgOverlay.detach(),f.wrap.detach(),f.container.empty(),f.st.mainClass&&(e+=f.st.mainClass+" "),f._removeClassFromMFP(e),f.fixedContentPos&&(e={marginRight:""},f.isIE7?c("body, html").css("overflow",""):e.overflow="",c("html").css(e)),g.off("keyup.mfp focusin"+x),f.ev.off(x),f.wrap.attr("class","mfp-wrap").removeAttr("style"),f.bgOverlay.attr("class","mfp-bg"),f.container.attr("class","mfp-container"),!f.st.showCloseBtn||f.st.closeBtnInside&&!0!==f.currTemplate[f.currItem.type]||f.currTemplate.closeBtn&&f.currTemplate.closeBtn.detach(),f.st.autoFocusLast&&f._lastFocusedEl&&c(f._lastFocusedEl).focus(),f.currItem=null,f.content=null,f.currTemplate=null,f.prevHeight=0,p("AfterClose")},updateSize:function(e){var t;f.isIOS?(t=document.documentElement.clientWidth/window.innerWidth,t=window.innerHeight*t,f.wrap.css("height",t),f.wH=t):f.wH=e||P.height(),f.fixedContentPos||f.wrap.css("height",f.wH),p("Resize")},updateItemHTML:function(){var e=f.items[f.index],t=(f.contentContainer.detach(),f.content&&f.content.detach(),(e=e.parsed?e:f.parseEl(f.index)).type),n=(p("BeforeChange",[f.currItem?f.currItem.type:"",t]),f.currItem=e,f.currTemplate[t]||(n=!!f.st[t]&&f.st[t].markup,p("FirstMarkupParse",n),f.currTemplate[t]=!n||c(n)),s&&s!==e.type&&f.container.removeClass("mfp-"+s+"-holder"),f["get"+t.charAt(0).toUpperCase()+t.slice(1)](e,f.currTemplate[t]));f.appendContent(n,t),e.preloaded=!0,p(j,e),s=e.type,f.container.prepend(f.contentContainer),p("AfterChange")},appendContent:function(e,t){(f.content=e)?f.st.showCloseBtn&&f.st.closeBtnInside&&!0===f.currTemplate[t]?f.content.find(".mfp-close").length||f.content.append(m()):f.content=e:f.content="",p("BeforeAppend"),f.container.addClass("mfp-"+t+"-holder"),f.contentContainer.append(f.content)},parseEl:function(e){var t,n=f.items[e];if((n=n.tagName?{el:c(n)}:(t=n.type,{data:n,src:n.src})).el){for(var a=f.types,o=0;o<a.length;o++)if(n.el.hasClass("mfp-"+a[o])){t=a[o];break}n.src=n.el.attr("data-mfp-src"),n.src||(n.src=n.el.attr("href"))}return n.type=t||f.st.type||"inline",n.index=e,n.parsed=!0,f.items[e]=n,p("ElementParse",n),f.items[e]},addGroup:function(t,n){function e(e){e.mfpEl=this,f._openClick(e,t,n)}var a="click.magnificPopup";(n=n||{}).mainEl=t,n.items?(n.isObj=!0,t.off(a).on(a,e)):(n.isObj=!1,n.delegate?t.off(a).on(a,n.delegate,e):(n.items=t).off(a).on(a,e))},_openClick:function(e,t,n){var a=(void 0!==n.midClick?n:c.magnificPopup.defaults).midClick;if(a||!(2===e.which||e.ctrlKey||e.metaKey||e.altKey||e.shiftKey)){a=(void 0!==n.disableOn?n:c.magnificPopup.defaults).disableOn;if(a)if(c.isFunction(a)){if(!a.call(f))return!0}else if(P.width()<a)return!0;e.type&&(e.preventDefault(),f.isOpen&&e.stopPropagation()),n.el=c(e.mfpEl),n.delegate&&(n.items=t.find(n.delegate)),f.open(n)}},updateStatus:function(e,t){var n;f.preloader&&(a!==e&&f.container.removeClass("mfp-s-"+a),n={status:e,text:t=t||"loading"!==e?t:f.st.tLoading},p("UpdateStatus",n),e=n.status,f.preloader.html(t=n.text),f.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),f.container.addClass("mfp-s-"+e),a=e)},_checkIfClose:function(e){if(!c(e).hasClass(k)){var t=f.st.closeOnContentClick,n=f.st.closeOnBgClick;if(t&&n)return!0;if(!f.content||c(e).hasClass("mfp-close")||f.preloader&&e===f.preloader[0])return!0;if(e===f.content[0]||c.contains(f.content[0],e)){if(t)return!0}else if(n&&c.contains(document,e))return!0;return!1}},_addClassToMFP:function(e){f.bgOverlay.addClass(e),f.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),f.wrap.removeClass(e)},_hasScrollBar:function(e){return(f.isIE7?g.height():document.body.scrollHeight)>(e||P.height())},_setFocus:function(){(f.st.focus?f.content.find(f.st.focus).eq(0):f.wrap).focus()},_onFocusIn:function(e){if(e.target!==f.wrap[0]&&!c.contains(f.wrap[0],e.target))return f._setFocus(),!1},_parseMarkup:function(o,e,t){var i;t.data&&(e=c.extend(t.data,e)),p(b,[o,e,t]),c.each(e,function(e,t){if(void 0===t||!1===t)return!0;var n,a;1<(i=e.split("_")).length?0<(n=o.find(x+"-"+i[0])).length&&("replaceWith"===(a=i[1])?n[0]!==t[0]&&n.replaceWith(t):"img"===a?n.is("img")?n.attr("src",t):n.replaceWith(c("<img>").attr("src",t).attr("class",n.attr("class"))):n.attr(i[1],t)):o.find(x+"-"+e).html(t)})},_getScrollbarSize:function(){var e;return void 0===f.scrollbarSize&&((e=document.createElement("div")).style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),f.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)),f.scrollbarSize}},modules:[],open:function(e,t){return i(),(e=e?c.extend(!0,{},e):{}).isObj=!0,e.index=t||0,this.instance.open(e)},close:function(){return c.magnificPopup.instance&&c.magnificPopup.instance.close()},registerModule:function(e,t){t.options&&(c.magnificPopup.defaults[e]=t.options),c.extend(this.proto,t.proto),this.modules.push(e)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&#215;</button>',tClose:"Close (Esc)",tLoading:"Loading...",autoFocusLast:!0}},c.fn.magnificPopup=function(e){i();var t,n,a,o=c(this);return"string"==typeof e?"open"===e?(t=T?o.data("magnificPopup"):o[0].magnificPopup,n=parseInt(arguments[1],10)||0,a=t.items?t.items[n]:(a=o,(a=t.delegate?a.find(t.delegate):a).eq(n)),f._openClick({mfpEl:a},o,t)):f.isOpen&&f[e].apply(f,Array.prototype.slice.call(arguments,1)):(e=c.extend(!0,{},e),T?o.data("magnificPopup",e):o[0].magnificPopup=e,f.addGroup(o,e)),o},"inline"),E=(c.magnificPopup.registerModule(S,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){f.types.push(S),u(_+"."+S,function(){r()})},getInline:function(e,t){var n,a,o;return r(),e.src?(n=f.st.inline,(a=c(e.src)).length?((o=a[0].parentNode)&&o.tagName&&(v||(l=n.hiddenClass,v=d(l),l="mfp-"+l),y=a.after(v).detach().removeClass(l)),f.updateStatus("ready")):(f.updateStatus("error",n.tNotFound),a=c("<div>")),e.inlineElement=a):(f.updateStatus("ready"),f._parseMarkup(t,{},e),t)}}}),"ajax");c.magnificPopup.registerModule(E,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){f.types.push(E),n=f.st.ajax.cursor,u(_+"."+E,t),u("BeforeChange."+E,t)},getAjax:function(a){n&&c(document.body).addClass(n),f.updateStatus("loading");var e=c.extend({url:a.src,success:function(e,t,n){e={data:e,xhr:n};p("ParseAjax",e),f.appendContent(c(e.data),E),a.finished=!0,o(),f._setFocus(),setTimeout(function(){f.wrap.addClass(I)},16),f.updateStatus("ready"),p("AjaxContentAdded")},error:function(){o(),a.finished=a.loadError=!0,f.updateStatus("error",f.st.ajax.tError.replace("%url%",a.src))}},f.st.ajax.settings);return f.req=c.ajax(e),""}}});var z;c.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=f.st.image,t=".image";f.types.push("image"),u(w+t,function(){"image"===f.currItem.type&&e.cursor&&c(document.body).addClass(e.cursor)}),u(_+t,function(){e.cursor&&c(document.body).removeClass(e.cursor),P.off("resize"+x)}),u("Resize"+t,f.resizeImage),f.isLowIE&&u("AfterChange",f.resizeImage)},resizeImage:function(){var e,t=f.currItem;t&&t.img&&f.st.image.verticalFit&&(e=0,f.isLowIE&&(e=parseInt(t.img.css("padding-top"),10)+parseInt(t.img.css("padding-bottom"),10)),t.img.css("max-height",f.wH-e))},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,z&&clearInterval(z),e.isCheckingImgSize=!1,p("ImageHasSize",e),e.imgHidden&&(f.content&&f.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(t){function n(e){z&&clearInterval(z),z=setInterval(function(){0<o.naturalWidth?f._onImageHasSize(t):(200<a&&clearInterval(z),3===++a?n(10):40===a?n(50):100===a&&n(500))},e)}var a=0,o=t.img[0];n(1)},getImage:function(e,t){function n(){e&&(e.img[0].complete?(e.img.off(".mfploader"),e===f.currItem&&(f._onImageHasSize(e),f.updateStatus("ready")),e.hasSize=!0,e.loaded=!0,p("ImageLoadComplete")):++i<200?setTimeout(n,100):a())}function a(){e&&(e.img.off(".mfploader"),e===f.currItem&&(f._onImageHasSize(e),f.updateStatus("error",r.tError.replace("%url%",e.src))),e.hasSize=!0,e.loaded=!0,e.loadError=!0)}var o,i=0,r=f.st.image,s=t.find(".mfp-img");return s.length&&((o=document.createElement("img")).className="mfp-img",e.el&&e.el.find("img").length&&(o.alt=e.el.find("img").attr("alt")),e.img=c(o).on("load.mfploader",n).on("error.mfploader",a),o.src=e.src,s.is("img")&&(e.img=e.img.clone()),0<(o=e.img[0]).naturalWidth?e.hasSize=!0:o.width||(e.hasSize=!1)),f._parseMarkup(t,{title:function(e){if(e.data&&void 0!==e.data.title)return e.data.title;var t=f.st.image.titleSrc;if(t){if(c.isFunction(t))return t.call(f,e);if(e.el)return e.el.attr(t)||""}return""}(e),img_replaceWith:e.img},e),f.resizeImage(),e.hasSize?(z&&clearInterval(z),e.loadError?(t.addClass("mfp-loading"),f.updateStatus("error",r.tError.replace("%url%",e.src))):(t.removeClass("mfp-loading"),f.updateStatus("ready"))):(f.updateStatus("loading"),e.loading=!0,e.hasSize||(e.imgHidden=!0,t.addClass("mfp-loading"),f.findImageSize(e))),t}}});function O(e){var t;f.currTemplate[F]&&(t=f.currTemplate[F].find("iframe")).length&&(e||(t[0].src="//about:blank"),f.isIE8&&t.css("display",e?"block":"none"))}function M(e){var t=f.items.length;return t-1<e?e-t:e<0?t+e:e}function N(e,t,n){return e.replace(/%curr%/gi,t+1).replace(/%total%/gi,n)}c.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e,t,n,a,o,i,r=f.st.zoom,s=".zoom";r.enabled&&f.supportsTransition&&(t=r.duration,n=function(e){var e=e.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),t="all "+r.duration/1e3+"s "+r.easing,n={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},a="transition";return n["-webkit-"+a]=n["-moz-"+a]=n["-o-"+a]=n[a]=t,e.css(n),e},a=function(){f.content.css("visibility","visible")},u("BuildControls"+s,function(){f._allowZoom()&&(clearTimeout(o),f.content.css("visibility","hidden"),(e=f._getItemToZoom())?((i=n(e)).css(f._getOffset()),f.wrap.append(i),o=setTimeout(function(){i.css(f._getOffset(!0)),o=setTimeout(function(){a(),setTimeout(function(){i.remove(),e=i=null,p("ZoomAnimationEnded")},16)},t)},16)):a())}),u(H+s,function(){if(f._allowZoom()){if(clearTimeout(o),f.st.removalDelay=t,!e){if(!(e=f._getItemToZoom()))return;i=n(e)}i.css(f._getOffset(!0)),f.wrap.append(i),f.content.css("visibility","hidden"),setTimeout(function(){i.css(f._getOffset())},16)}}),u(_+s,function(){f._allowZoom()&&(a(),i&&i.remove(),e=null)}))},_allowZoom:function(){return"image"===f.currItem.type},_getItemToZoom:function(){return!!f.currItem.hasSize&&f.currItem.img},_getOffset:function(e){var e=e?f.currItem.img:f.st.zoom.opener(f.currItem.el||f.currItem),t=e.offset(),n=parseInt(e.css("padding-top"),10),a=parseInt(e.css("padding-bottom"),10),e=(t.top-=c(window).scrollTop()-n,{width:e.width(),height:(T?e.innerHeight():e[0].offsetHeight)-a-n});return(B=void 0===B?void 0!==document.createElement("p").style.MozTransform:B)?e["-moz-transform"]=e.transform="translate("+t.left+"px,"+t.top+"px)":(e.left=t.left,e.top=t.top),e}}});var B,F="iframe",L=(c.magnificPopup.registerModule(F,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){f.types.push(F),u("BeforeChange",function(e,t,n){t!==n&&(t===F?O():n===F&&O(!0))}),u(_+"."+F,function(){O()})},getIframe:function(e,t){var n=e.src,a=f.st.iframe,o=(c.each(a.patterns,function(){if(-1<n.indexOf(this.index))return this.id&&(n="string"==typeof this.id?n.substr(n.lastIndexOf(this.id)+this.id.length,n.length):this.id.call(this,n)),n=this.src.replace("%id%",n),!1}),{});return a.srcAction&&(o[a.srcAction]=n),f._parseMarkup(t,o,e),f.updateStatus("ready"),t}}}),c.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var i=f.st.gallery,e=".mfp-gallery";if(f.direction=!0,!i||!i.enabled)return!1;h+=" mfp-gallery",u(w+e,function(){i.navigateByImgClick&&f.wrap.on("click"+e,".mfp-img",function(){if(1<f.items.length)return f.next(),!1}),g.on("keydown"+e,function(e){37===e.keyCode?f.prev():39===e.keyCode&&f.next()})}),u("UpdateStatus"+e,function(e,t){t.text&&(t.text=N(t.text,f.currItem.index,f.items.length))}),u(b+e,function(e,t,n,a){var o=f.items.length;n.counter=1<o?N(i.tCounter,a.index,o):""}),u("BuildControls"+e,function(){var e,t;1<f.items.length&&i.arrows&&!f.arrowLeft&&(t=i.arrowMarkup,e=f.arrowLeft=c(t.replace(/%title%/gi,i.tPrev).replace(/%dir%/gi,"left")).addClass(k),t=f.arrowRight=c(t.replace(/%title%/gi,i.tNext).replace(/%dir%/gi,"right")).addClass(k),e.click(function(){f.prev()}),t.click(function(){f.next()}),f.container.append(e.add(t)))}),u(j+e,function(){f._preloadTimeout&&clearTimeout(f._preloadTimeout),f._preloadTimeout=setTimeout(function(){f.preloadNearbyImages(),f._preloadTimeout=null},16)}),u(_+e,function(){g.off(e),f.wrap.off("click"+e),f.arrowRight=f.arrowLeft=null})},next:function(){f.direction=!0,f.index=M(f.index+1),f.updateItemHTML()},prev:function(){f.direction=!1,f.index=M(f.index-1),f.updateItemHTML()},goTo:function(e){f.direction=e>=f.index,f.index=e,f.updateItemHTML()},preloadNearbyImages:function(){for(var e=f.st.gallery.preload,t=Math.min(e[0],f.items.length),n=Math.min(e[1],f.items.length),a=1;a<=(f.direction?n:t);a++)f._preloadItem(f.index+a);for(a=1;a<=(f.direction?t:n);a++)f._preloadItem(f.index-a)},_preloadItem:function(e){var t;e=M(e),f.items[e].preloaded||((t=f.items[e]).parsed||(t=f.parseEl(e)),p("LazyLoad",t),"image"===t.type&&(t.img=c('<img class="mfp-img" />').on("load.mfploader",function(){t.hasSize=!0}).on("error.mfploader",function(){t.hasSize=!0,t.loadError=!0,p("LazyLoadError",t)}).attr("src",t.src)),t.preloaded=!0)}}}),"retina");c.magnificPopup.registerModule(L,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){var n,a;1<window.devicePixelRatio&&(n=f.st.retina,a=n.ratio,1<(a=isNaN(a)?a():a)&&(u("ImageHasSize."+L,function(e,t){t.img.css({"max-width":t.img[0].naturalWidth/a,width:"100%"})}),u("ElementParse."+L,function(e,t){t.src=n.replaceSrc(t,a)})))}}}),i()}),jQuery(document).ready(function(e){e(".category-dropdown").on("change",function(){location.href="/category/"+e(this).val()})}),jQuery(document).ready(function(t){t("a.btn[download]").on("click",function(e){e.preventDefault(),forceDownload(t(this).attr("href"),t(this).attr("download"))})}),function(p){p.extend(p.fn,{accrue:function(o){return o=p.extend({calculationMethod:e},p.fn.accrue.options,o),this.each(function(){var t,n,a=p(this);a.find(".form").length||a.append('<div class="form"></div>'),m(a,o,"amount"),m(a,o,"rate"),m(a,o,"term");switch("compare"==o.mode&&m(a,o,"rate_compare"),t=".results"===o.response_output_div?(0===a.find(".results").length&&a.append('<div class="results"></div>'),a.find(".results")):p(o.response_output_div),o.mode){case"basic":n=e;break;case"compare":n=i;break;case"amortization":n=r}n(a,o,t),"button"==o.operation?(0===a.find("button").length&&0===a.find("input[type=submit]").length&&0===a.find("input[type=image]").length&&a.find(".form").append('<button class="accrue-calculate">'+o.button_label+"</button>"),a.find("button, input[type=submit], input[type=image]").each(function(){p(this).click(function(e){e.preventDefault(),n(a,o,t)})})):a.find("input, select").each(function(){p(this).bind("keyup change",function(){n(a,o,t)})}),a.find("form").each(function(){p(this).submit(function(e){e.preventDefault(),n(a,o,t)})})})}}),p.fn.accrue.options={mode:"basic",operation:"keyup",default_values:{amount:"$7,500",rate:"7%",rate_compare:"1.49%",term:"36m"},field_titles:{amount:"Loan Amount",rate:"Rate (APR)",rate_compare:"Comparison Rate",term:"Term"},button_label:"Calculate",field_comments:{amount:"",rate:"",rate_compare:"",term:"Format: 12m, 36m, 3y, 7y"},response_output_div:".results",response_basic:"<p><strong>Monthly Payment:</strong><br />$%payment_amount%</p><p><strong>Number of Payments:</strong><br />%num_payments%</p><p><strong>Total Payments:</strong><br />$%total_payments%</p><p><strong>Total Interest:</strong><br />$%total_interest%</p>",response_compare:'<p class="total-savings">Save $%savings% in interest!</p>',error_text:'<p class="error">Please fill in all fields.</p>',callback:function(e,t){}};var m=function(e,t,n){var a;return e.find(".accrue-"+n).length?a=e.find(".accrue-"+n):e.find("."+n).length?a=e.find("."+n):e.find("input[name~="+n+"]").length?e.find("input[name~="+n+"]"):a="","string"!=typeof a?a.val():"term_compare"!=n&&(e.find(".form").append('<div class="accrue-field-'+n+'"><p><label>'+t.field_titles[n]+':</label><input type="text" class="'+n+'" value="'+t.default_values[n]+'" />'+(0<t.field_comments[n].length?"<small>"+t.field_comments[n]+"</small>":"")+"</p></div>"),e.find("."+n).val())},e=function(e,t,n){var a,o=p.loanInfo({amount:m(e,t,"amount"),rate:m(e,t,"rate"),term:m(e,t,"term")});0!==o?(a=t.response_basic.replace("%payment_amount%",o.payment_amount_formatted).replace("%num_payments%",o.num_payments).replace("%total_payments%",o.total_payments_formatted).replace("%total_interest%",o.total_interest_formatted),n.html(a)):n.html(t.error_text),t.callback(e,o)},i=function(e,t,n){var a=m(e,t,"term_compare"),o=("boolean"==typeof a&&(a=m(e,t,"term")),p.loanInfo({amount:m(e,t,"amount"),rate:m(e,t,"rate"),term:m(e,t,"term")})),a=p.loanInfo({amount:m(e,t,"amount"),rate:m(e,t,"rate_compare"),term:a}),i={loan_1:o,loan_2:a};0!==o&&0!==a?(0<o.total_interest-a.total_interest?i.savings=o.total_interest-a.total_interest:i.savings=0,a=t.response_compare.replace("%savings%",i.savings.toFixed(2)).replace("%loan_1_payment_amount%",a.payment_amount_formatted).replace("%loan_1_num_payments%",a.num_payments).replace("%loan_1_total_payments%",a.total_payments_formatted).replace("%loan_1_total_interest%",a.total_interest_formatted).replace("%loan_2_payment_amount%",o.payment_amount_formatted).replace("%loan_2_num_payments%",o.num_payments).replace("%loan_2_total_payments%",o.total_payments_formatted).replace("%loan_2_total_interest%",o.total_interest_formatted),n.html(a)):n.html(t.error_text),t.callback(e,i)},r=function(e,t,n){var a=p.loanInfo({amount:m(e,t,"amount"),rate:m(e,t,"rate"),term:m(e,t,"term")});if(0!==a){for(var o='<table class="accrue-amortization"><tr><th class="accrue-payment-number">#</th><th class="accrue-payment-amount">Payment Amt.</th><th class="accrue-total-interest">Total Interest</th><th class="accrue-total-payments">Total Payments</th><th class="accrue-balance">Balance</th></tr>',i=a.payment_amount-a.original_amount/a.num_payments,r=a.payment_amount-i,s=0,l=0,c=parseInt(a.original_amount),u=0;u<a.num_payments;u++){s+=i,l+=a.payment_amount,c-=r;var d="td",o=o+"<tr><"+(d=u==a.num_payments-1?"th":d)+' class="accrue-payment-number">'+(u+1)+"</"+d+"><"+d+' class="accrue-payment-amount">$'+a.payment_amount_formatted+"</"+d+"><"+d+' class="accrue-total-interest">$'+s.toFixed(2)+"</"+d+"><"+d+' class="accrue-total-payments">$'+l.toFixed(2)+"</"+d+"><"+d+' class="accrue-balance">$'+c.toFixed(2)+"</"+d+"></tr>"}n.html(o+="</table>")}else n.html(t.error_text);t.callback(e,a)};p.loanInfo=function(e){var t=(void 0!==e.amount?e.amount:0).replace(/[^\d.]/gi,""),n=(void 0!==e.rate?e.rate:0).replace(/[^\d.]/gi,""),e=(e=void 0!==e.term?e.term:0).match("y")?12*parseInt(e.replace(/[^\d.]/gi,"")):parseInt(e.replace(/[^\d.]/gi,"")),a=n/100/12,o=Math.pow(1+a,e),a=t*o*a/(o-1);return 0<t*n*e?{original_amount:t,payment_amount:a,payment_amount_formatted:a.toFixed(2),num_payments:e,total_payments:a*e,total_payments_formatted:(a*e).toFixed(2),total_interest:a*e-t,total_interest_formatted:(a*e-t).toFixed(2)}:0}}(jQuery,(window,document)),jQuery(document).ready(function(e){e(".calculator-compare").accrue({mode:"compare"}),e(".calculator-loan").accrue()}),jQuery(document).ready(function(n){var e=n("header nav"),t=e.find("button.menu-toggle"),a=e.find(".nav-menu");t.click(function(){a.is(":visible")?a.hide():a.show(),a.find("a").click(function(){var e=n(this).parent("li"),t=n(this).next("ul");!t.is(":visible")&&e.hasClass("menu-item-has-children")&&(event.preventDefault(),e.addClass("open"),t.show())})}),n(".lightbox-iframe").magnificPopup({type:"iframe"}),n(".lightbox").magnificPopup({type:"image"}),n(".icons .icon").on("click",function(){var e=n(this);e.hasClass("lightbox-icon")?n.magnificPopup.open({items:{src:e.attr("data-href")},type:"iframe"}):location.href=e.attr("data-href")})}),jQuery(document).ready(function(e){e("pre,code").each(function(){e(this).html(e(this).html().replace(/{/g,"[").replace(/}/g,"]"))})}),jQuery(document).ready(function(u){u(".showcase").each(function(){var n,a,o,i,r,s=u(this),l=0,c=s.find(".slide").size();void 0!==s&&(n=s.find(".slide.visible"),a=s.find(".slide").last(),o=function(){var e=i(),t=e.next(".slide");t.length||(t=n),e.attr("class","slide hide-left"),t.attr("class","slide visible"),setTimeout(function(){e.attr("class","slide")},400),r()},i=function(){return s.find(".slide.visible")},r=function(){var e,t=i(),n=t.find("img");e=s.find(".slide-wrapper").length?2*s.find(".slide-wrapper").css("margin-top").replace("px",""):0,768<=u(window).width()?s.height(n.height()+e):s.height(t.height())},setTimeout(function(){r(),1<c&&(l=setInterval(o,1e4))},500),u(window).resize(function(){i();r()}),s.find(".showcase-nav a").click(function(){var e,t;u(this).hasClass("previous")?(e=i(),(t=e.prev(".slide")).length||(t=a),e.attr("class","slide"),t.attr("class","slide visible"),setTimeout(function(){e.attr("class","slide hide-left")},400),r()):o(),1<c&&clearInterval(l)}),s.find(".showcase-nav a.previous").hover(function(){s.find(".slide:not(.visible)").attr("class","slide hide-left")}),s.find(".showcase-nav a.next").hover(function(){s.find(".showcase .slide:not(.visible)").attr("class","slide")}))})});
//# sourceMappingURL=main.js.map