/*
 * Globalize Culture lt
 *
 * http://github.com/jquery/globalize
 *
 * Copyright Software Freedom Conservancy, Inc.
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * This file was generated by the Globalize Culture Generator
 * Translation: bugs found in this file need to be fixed in the generator
 */

(function( window, undefined ) {

var Globalize;

if ( typeof require !== "undefined" &&
	typeof exports !== "undefined" &&
	typeof module !== "undefined" ) {
	// Assume CommonJS
	Globalize = require( "globalize" );
} else {
	// Global variable
	Globalize = window.Globalize;
}

Globalize.addCultureInfo( "lt", "default", {
	name: "lt",
	englishName: "Lithuanian",
	nativeName: "lietuvių",
	language: "lt",
	numberFormat: {
		",": ".",
		".": ",",
		negativeInfinity: "-begalybė",
		positiveInfinity: "begalybė",
		percent: {
			pattern: ["-n%","n%"],
			",": ".",
			".": ","
		},
		currency: {
			pattern: ["-n $","n $"],
			",": ".",
			".": ",",
			symbol: "Lt"
		}
	},
	calendars: {
		standard: {
			"/": ".",
			firstDay: 1,
			days: {
				names: ["sekmadienis","pirmadienis","antradienis","trečiadienis","ketvirtadienis","penktadienis","šeštadienis"],
				namesAbbr: ["Sk","Pr","An","Tr","Kt","Pn","Št"],
				namesShort: ["S","P","A","T","K","Pn","Š"]
			},
			months: {
				names: ["sausis","vasaris","kovas","balandis","gegužė","birželis","liepa","rugpjūtis","rugsėjis","spalis","lapkritis","gruodis",""],
				namesAbbr: ["Sau","Vas","Kov","Bal","Geg","Bir","Lie","Rgp","Rgs","Spl","Lap","Grd",""]
			},
			monthsGenitive: {
				names: ["sausio","vasario","kovo","balandžio","gegužės","birželio","liepos","rugpjūčio","rugsėjo","spalio","lapkričio","gruodžio",""],
				namesAbbr: ["Sau","Vas","Kov","Bal","Geg","Bir","Lie","Rgp","Rgs","Spl","Lap","Grd",""]
			},
			AM: null,
			PM: null,
			patterns: {
				d: "yyyy.MM.dd",
				D: "yyyy 'm.' MMMM d 'd.'",
				t: "HH:mm",
				T: "HH:mm:ss",
				f: "yyyy 'm.' MMMM d 'd.' HH:mm",
				F: "yyyy 'm.' MMMM d 'd.' HH:mm:ss",
				M: "MMMM d 'd.'",
				Y: "yyyy 'm.' MMMM"
			}
		}
	}
});

}( this ));
