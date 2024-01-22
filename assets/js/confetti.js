/**
 * Minified by jsDelivr using Terser v5.10.0.
 * Original file: /npm/canvas-confetti@1.5.1/dist/confetti.browser.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
!function(t,e){!function t(e,n,a,i){var o=!!(e.Worker&&e.Blob&&e.Promise&&e.OffscreenCanvas&&e.OffscreenCanvasRenderingContext2D&&e.HTMLCanvasElement&&e.HTMLCanvasElement.prototype.transferControlToOffscreen&&e.URL&&e.URL.createObjectURL);function r(){}function l(t){var a=n.exports.Promise,i=void 0!==a?a:e.Promise;return"function"==typeof i?new i(t):(t(r,r),null)}var c,s,u,d,f,h,m,g,b,v=(u=Math.floor(1e3/60),d={},f=0,"function"==typeof requestAnimationFrame&&"function"==typeof cancelAnimationFrame?(c=function(t){var e=Math.random();return d[e]=requestAnimationFrame((function n(a){f===a||f+u-1<a?(f=a,delete d[e],t()):d[e]=requestAnimationFrame(n)})),e},s=function(t){d[t]&&cancelAnimationFrame(d[t])}):(c=function(t){return setTimeout(t,u)},s=function(t){return clearTimeout(t)}),{frame:c,cancel:s}),p=(g={},function(){if(h)return h;if(!a&&o){var e=["var CONFETTI, SIZE = {}, module = {};","("+t.toString()+")(this, module, true, SIZE);","onmessage = function(msg) {","  if (msg.data.options) {","    CONFETTI(msg.data.options).then(function () {","      if (msg.data.callback) {","        postMessage({ callback: msg.data.callback });","      }","    });","  } else if (msg.data.reset) {","    CONFETTI.reset();","  } else if (msg.data.resize) {","    SIZE.width = msg.data.resize.width;","    SIZE.height = msg.data.resize.height;","  } else if (msg.data.canvas) {","    SIZE.width = msg.data.canvas.width;","    SIZE.height = msg.data.canvas.height;","    CONFETTI = module.exports.create(msg.data.canvas);","  }","}"].join("\n");try{h=new Worker(URL.createObjectURL(new Blob([e])))}catch(t){return void 0!==typeof console&&"function"==typeof console.warn&&console.warn("ðŸŽŠ Could not load worker",t),null}!function(t){function e(e,n){t.postMessage({options:e||{},callback:n})}t.init=function(e){var n=e.transferControlToOffscreen();t.postMessage({canvas:n},[n])},t.fire=function(n,a,i){if(m)return e(n,null),m;var o=Math.random().toString(36).slice(2);return m=l((function(a){function r(e){e.data.callback===o&&(delete g[o],t.removeEventListener("message",r),m=null,i(),a())}t.addEventListener("message",r),e(n,o),g[o]=r.bind(null,{data:{callback:o}})}))},t.reset=function(){for(var e in t.postMessage({reset:!0}),g)g[e](),delete g[e]}}(h)}return h}),y={particleCount:50,angle:90,spread:45,startVelocity:45,decay:.9,gravity:1,drift:0,ticks:200,x:.5,y:.5,shapes:["square","circle"],zIndex:100,colors:["#26ccff","#a25afd","#ff5e7e","#88ff5a","#fcff42","#ffa62d","#ff36ff"],disableForReducedMotion:!1,scalar:1};function M(t,e,n){return function(t,e){return e?e(t):t}(t&&null!=t[e]?t[e]:y[e],n)}function w(t){return t<0?0:Math.floor(t)}function x(t){return parseInt(t,16)}function C(t){return t.map(k)}function k(t){var e=String(t).replace(/[^0-9a-f]/gi,"");return e.length<6&&(e=e[0]+e[0]+e[1]+e[1]+e[2]+e[2]),{r:x(e.substring(0,2)),g:x(e.substring(2,4)),b:x(e.substring(4,6))}}function I(t){t.width=document.documentElement.clientWidth,t.height=document.documentElement.clientHeight}function S(t){var e=t.getBoundingClientRect();t.width=e.width,t.height=e.height}function T(t,e,n,o,r){var c,s,u=e.slice(),d=t.getContext("2d"),f=l((function(e){function l(){c=s=null,d.clearRect(0,0,o.width,o.height),r(),e()}c=v.frame((function e(){!a||o.width===i.width&&o.height===i.height||(o.width=t.width=i.width,o.height=t.height=i.height),o.width||o.height||(n(t),o.width=t.width,o.height=t.height),d.clearRect(0,0,o.width,o.height),u=u.filter((function(t){return function(t,e){e.x+=Math.cos(e.angle2D)*e.velocity+e.drift,e.y+=Math.sin(e.angle2D)*e.velocity+e.gravity,e.wobble+=e.wobbleSpeed,e.velocity*=e.decay,e.tiltAngle+=.1,e.tiltSin=Math.sin(e.tiltAngle),e.tiltCos=Math.cos(e.tiltAngle),e.random=Math.random()+2,e.wobbleX=e.x+10*e.scalar*Math.cos(e.wobble),e.wobbleY=e.y+10*e.scalar*Math.sin(e.wobble);var n=e.tick++/e.totalTicks,a=e.x+e.random*e.tiltCos,i=e.y+e.random*e.tiltSin,o=e.wobbleX+e.random*e.tiltCos,r=e.wobbleY+e.random*e.tiltSin;return t.fillStyle="rgba("+e.color.r+", "+e.color.g+", "+e.color.b+", "+(1-n)+")",t.beginPath(),"circle"===e.shape?t.ellipse?t.ellipse(e.x,e.y,Math.abs(o-a)*e.ovalScalar,Math.abs(r-i)*e.ovalScalar,Math.PI/10*e.wobble,0,2*Math.PI):function(t,e,n,a,i,o,r,l,c){t.save(),t.translate(e,n),t.rotate(o),t.scale(a,i),t.arc(0,0,1,r,l,c),t.restore()}(t,e.x,e.y,Math.abs(o-a)*e.ovalScalar,Math.abs(r-i)*e.ovalScalar,Math.PI/10*e.wobble,0,2*Math.PI):(t.moveTo(Math.floor(e.x),Math.floor(e.y)),t.lineTo(Math.floor(e.wobbleX),Math.floor(i)),t.lineTo(Math.floor(o),Math.floor(r)),t.lineTo(Math.floor(a),Math.floor(e.wobbleY))),t.closePath(),t.fill(),e.tick<e.totalTicks}(d,t)})),u.length?c=v.frame(e):l()})),s=l}));return{addFettis:function(t){return u=u.concat(t),f},canvas:t,promise:f,reset:function(){c&&v.cancel(c),s&&s()}}}function E(t,n){var a,i=!t,r=!!M(n||{},"resize"),c=M(n,"disableForReducedMotion",Boolean),s=o&&!!M(n||{},"useWorker")?p():null,u=i?I:S,d=!(!t||!s)&&!!t.__confetti_initialized,f="function"==typeof matchMedia&&matchMedia("(prefers-reduced-motion)").matches;function h(e,n,i){for(var o,r,l,c,s,d=M(e,"particleCount",w),f=M(e,"angle",Number),h=M(e,"spread",Number),m=M(e,"startVelocity",Number),g=M(e,"decay",Number),b=M(e,"gravity",Number),v=M(e,"drift",Number),p=M(e,"colors",C),y=M(e,"ticks",Number),x=M(e,"shapes"),k=M(e,"scalar"),I=function(t){var e=M(t,"origin",Object);return e.x=M(e,"x",Number),e.y=M(e,"y",Number),e}(e),S=d,E=[],F=t.width*I.x,N=t.height*I.y;S--;)E.push((o={x:F,y:N,angle:f,spread:h,startVelocity:m,color:p[S%p.length],shape:x[(c=0,s=x.length,Math.floor(Math.random()*(s-c))+c)],ticks:y,decay:g,gravity:b,drift:v,scalar:k},r=void 0,l=void 0,r=o.angle*(Math.PI/180),l=o.spread*(Math.PI/180),{x:o.x,y:o.y,wobble:10*Math.random(),wobbleSpeed:Math.min(.11,.1*Math.random()+.05),velocity:.5*o.startVelocity+Math.random()*o.startVelocity,angle2D:-r+(.5*l-Math.random()*l),tiltAngle:(.5*Math.random()+.25)*Math.PI,color:o.color,shape:o.shape,tick:0,totalTicks:o.ticks,decay:o.decay,drift:o.drift,random:Math.random()+2,tiltSin:0,tiltCos:0,wobbleX:0,wobbleY:0,gravity:3*o.gravity,ovalScalar:.6,scalar:o.scalar}));return a?a.addFettis(E):(a=T(t,E,u,n,i)).promise}function m(n){var o=c||M(n,"disableForReducedMotion",Boolean),m=M(n,"zIndex",Number);if(o&&f)return l((function(t){t()}));i&&a?t=a.canvas:i&&!t&&(t=function(t){var e=document.createElement("canvas");return e.style.position="fixed",e.style.top="0px",e.style.left="0px",e.style.pointerEvents="none",e.style.zIndex=t,e}(m),document.body.appendChild(t)),r&&!d&&u(t);var g={width:t.width,height:t.height};function b(){if(s){var e={getBoundingClientRect:function(){if(!i)return t.getBoundingClientRect()}};return u(e),void s.postMessage({resize:{width:e.width,height:e.height}})}g.width=g.height=null}function v(){a=null,r&&e.removeEventListener("resize",b),i&&t&&(document.body.removeChild(t),t=null,d=!1)}return s&&!d&&s.init(t),d=!0,s&&(t.__confetti_initialized=!0),r&&e.addEventListener("resize",b,!1),s?s.fire(n,g,v):h(n,g,v)}return m.reset=function(){s&&s.reset(),a&&a.reset()},m}function F(){return b||(b=E(null,{useWorker:!0,resize:!0})),b}n.exports=function(){return F().apply(this,arguments)},n.exports.reset=function(){F().reset()},n.exports.create=E}(function(){return void 0!==t?t:"undefined"!=typeof self?self:this||{}}(),e,!1),t.confetti=e.exports}(window,{});
//# sourceMappingURL=/sm/ab60d7fb9bf5b5ded42c77782b65b071de85f56c21da42948364d6b2b1961762.map

async function wps_run_confetti( passed_defaults = {} ) {

	var defaults = {
		style: 'cannon',
		duration: 3,
		speed: 75,
		particleCount: 50,
		angle: 90,
		spread: 45,
		startVelocity: 45,
		decay: .9,
		gravity: 1,
		drift: 0,
		ticks: 200,
		origin: { x: .54, y: .5 },
		scalar: 1,
		zIndex: 9999999,
		disableForReducedMotion: 0,
		delay: 0
	};

	// Passed defaults get biggest priority
	if ( passed_defaults ) {
		for ( var key in passed_defaults ) {
			if ( key != 'origin' && passed_defaults[key] ) {
				defaults[key] = passed_defaults[key];
			}
		}
		// if ( typeof wps_confetti_defaults.origin !== 'undefined' ) {
		// 	// if ( typeof wps_confetti_defaults.origin.x !== 'undefined' && typeof wps_confetti_defaults.origin.y !== 'undefined' ) {
		// 		defaults["origin"] = { x: wps_confetti_defaults.origin[0], y: wps_confetti_defaults.origin[1] }
		// 	// }
		// }
	} else {
		// Merge defaults with any defaults set by PHP functions within page
		if ( typeof wps_confetti_defaults !== 'undefined' ) {
			for ( var key in wps_confetti_defaults ) {
				if ( key != 'origin' && wps_confetti_defaults[key] ) {
					defaults[key] = wps_confetti_defaults[key];
				}
			}
			if ( typeof wps_confetti_defaults.origin !== 'undefined' ) {
				// if ( typeof wps_confetti_defaults.origin.x !== 'undefined' && typeof wps_confetti_defaults.origin.y !== 'undefined' ) {
					defaults["origin"] = { x: wps_confetti_defaults.origin[0], y: wps_confetti_defaults.origin[1] }
				// }
			}
		}
	}

	if ( defaults.delay > 0 ) {
		await wps_confetti_sleep( defaults.delay * 1000 );
	}

	if ( defaults.style == 'cannon' ) {

		confetti( defaults );

	} else if ( defaults.style == 'cannon_real' ) {

		var count = defaults.particleCount;

		function fire(particleRatio, opts) {
			confetti(
				Object.assign(
					{},
					defaults,
					opts,
					{
						particleCount: Math.floor( count * particleRatio )
					}
				)
			);
		}

		fire(
			0.25,
			{
				spread: defaults.spread * .6,
				startVelocity: defaults.startVelocity * 1.2,
			}
		);
		fire(
			0.2,
			{
				spread: defaults.spread * 1.1,
			}
		);
		fire(
			0.35,
			{
				spread: defaults.spread * 2,
				decay: 0.91,
				scalar: defaults.scalar * .8
			}
		);
		fire(
			0.1,
			{
				spread: defaults.spread * 2.9,
				startVelocity: defaults.startVelocity * .6,
				decay: 0.92,
				scalar: defaults.scalar * 1.2
			}
		);
		fire(
			0.1,
			{
				spread: defaults.spread * 2.9,
				startVelocity: defaults.startVelocity,
			}
		);

	} else if ( defaults.style == 'cannon_repeat' ) {

		var duration     = defaults.duration * 1000;
		var animationEnd = Date.now() + duration;
		var speed        = 100 + ( 10 * ( 100 - defaults.speed ) );

		function randomInRange(min, max) {
			return Math.random() * (max - min) + min;
		}

		var interval = setInterval(
			function() {
				var timeLeft = animationEnd - Date.now();

				if (timeLeft <= 0) {
					return clearInterval( interval );
				}

				confetti(
					Object.assign(
						{},
						defaults,
						{
							angle: randomInRange( defaults.angle * .6, defaults.angle * 1.4 ),
							spread: randomInRange( defaults.spread * 1.1, defaults.spread * 1.2 ),
							particleCount: randomInRange( defaults.particleCount * .75, defaults.particleCount * 1.25 ),
						}
					)
				);

			},
			speed
		);

	} else if ( defaults.style == 'fireworks' ) {

		var duration     = defaults.duration * 1000;
		var animationEnd = Date.now() + duration;
		var speed        = 100 + ( 10 * ( 100 - defaults.speed ) );

		function randomInRange(min, max) {
			return Math.random() * (max - min) + min;
		}

		var interval = setInterval(
			function() {
				var timeLeft = animationEnd - Date.now();

				if (timeLeft <= 0) {
					return clearInterval( interval );
				}

				var particleCount = 50 * (timeLeft / duration);
				// since particles fall down, start a bit higher than random
				confetti( Object.assign( {}, defaults, { particleCount, spread: 360, origin: { x: randomInRange( 0.1, 0.3 ), y: Math.random() - 0.2 } } ) );
				confetti( Object.assign( {}, defaults, { particleCount, spread: 360, origin: { x: randomInRange( 0.7, 0.9 ), y: Math.random() - 0.2 } } ) );
			},
			speed
		);

	} else if ( defaults.style == 'falling' ) {

		var duration     = defaults.duration * 1000;
		var animationEnd = Date.now() + duration;
		var skew         = 1;

		function randomInRange(min, max) {
			return Math.random() * (max - min) + min;
		}

		(function frame() {
			var timeLeft = animationEnd - Date.now();
			var ticks    = Math.max( 200, 500 * (timeLeft / duration) );
			skew         = Math.max( 0.8, skew - 0.001 );

			if ( defaults.colors && defaults.colors.length > 0 ) {
				var colors = defaults.colors;
			} else {
				var colors = ["#26ccff","#a25afd","#ff5e7e","#88ff5a","#fcff42","#ffa62d","#ff36ff"];
			}

			confetti(
				Object.assign(
					{},
					defaults,
					{
						particleCount: 1,
						zIndex: 99999,
						startVelocity: 0,
						ticks: ticks,
						origin: {
							x: Math.random(),
							// since particles fall down, skew start toward the top
							y: (Math.random() * skew) - 0.2
						},
						colors: [ wps_confetti_get_random_color( colors ) ],
						gravity: randomInRange( 0.8, 1.4 ),
						scalar: randomInRange( 0.4, 1 ),
						drift: randomInRange( -0.4, 0.4 )
					}
				)
			);

			if (timeLeft > 0) {
				requestAnimationFrame( frame );
			}
		}());

	} else if ( defaults.style == 'school' ) {

		var end = Date.now() + (defaults.duration * 1000);

		if ( defaults.colors && defaults.colors.length > 0 ) {
			var colors = defaults.colors;
		} else {
			var colors = ["#26ccff","#a25afd","#ff5e7e","#88ff5a","#fcff42","#ffa62d","#ff36ff"];
		}

		(function frame() {
			confetti(
				Object.assign(
					{},
					defaults,
					{
						particleCount: 2,
						angle: 60,
						//spread: 55,
						origin: { x: 0 },
						colors: [ wps_confetti_get_random_color( colors ) ],
						zIndex: 99999
					}
				)
			);
			confetti(
				Object.assign(
					{},
					defaults,
					{
						particleCount: 2,
						angle: 120,
						//spread: 55,
						origin: { x: 1 },
						colors: [ wps_confetti_get_random_color( colors ) ],
						zIndex: 99999
					}
				)
			);

			if (Date.now() < end) {
				requestAnimationFrame( frame );
			}
		}());

	}

}

function wps_confetti_get_random_color( colors ) {
	return colors[ Math.floor( Math.random() * colors.length ) ];
}

function wps_confetti_sleep( ms ) {
	return new Promise( resolve => setTimeout( resolve, ms ) );
}