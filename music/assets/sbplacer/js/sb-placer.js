/*
 * SB Placer
 * Version: 0.0.1
 * https://github.com/alexfedoseev/sb-placer
 *
 * Copyright (c) Alex Fedoseev (http://www.alexfedoseev.com)
 * Licensed under the MIT license.
 */

$.fn.sb_placer = function(settings) {

  var target = this,
      rules = settings.conditions;

  function place_value(object, value) {
      // Empty this
      target.each(function(){
          $(this).empty();
      });
    object.each(function(){
      $(this).html(value);
    });
  }

  for (var i = 0; i < rules.length; i++) {

    // Multiple attributes check

    // Bad arrays
    if (rules[i].check instanceof Array && rules[i].when instanceof Array && rules[i].check.length !== rules[i].when.length) {
      // console.log('Oops! Bad arrays found!');
      continue;
    }

    // Good arrays
    if (rules[i].check instanceof Array && rules[i].when instanceof Array && rules[i].check.length === rules[i].when.length) {
      var place_it = false;
      for (var i1 = 0; i1 < rules[i].check.length; i1++) {
        if ( (rules[i].when[i1] instanceof RegExp && rules[i].check[i1].match(rules[i].when[i1])) ||
             (!(rules[i].when[i1] instanceof RegExp) && rules[i].when[i1].indexOf(rules[i].check[i1]) !== -1) ) {
          place_it = true;
        } else {
          place_it = false;
          break;
        }
      }
      if (place_it === true) {
        place_value(target, rules[i].place);
        return true;
      }
    }


    // Single attribute check
    if ( (rules[i].when instanceof RegExp && rules[i].check.match(rules[i].when)) ||
         (!(rules[i].when instanceof RegExp) && rules[i].when.indexOf(rules[i].check) !== -1) ) {
      place_value(target, rules[i].place);
      return true;
    }

  }

  // We have to place something
  if (settings.default_value.length) {
    place_value(target, settings.default_value);
  }
  return true;

};