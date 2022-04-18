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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 19);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.React;

/***/ }),
/* 1 */
/***/ (function(module, exports) {

module.exports = MailPoet;

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global, module) {var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;//     Underscore.js 1.9.0
//     http://underscorejs.org
//     (c) 2009-2018 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
//     Underscore may be freely distributed under the MIT license.

(function() {

  // Baseline setup
  // --------------

  // Establish the root object, `window` (`self`) in the browser, `global`
  // on the server, or `this` in some virtual machines. We use `self`
  // instead of `window` for `WebWorker` support.
  var root = typeof self == 'object' && self.self === self && self ||
            typeof global == 'object' && global.global === global && global ||
            this ||
            {};

  // Save the previous value of the `_` variable.
  var previousUnderscore = root._;

  // Save bytes in the minified (but not gzipped) version:
  var ArrayProto = Array.prototype, ObjProto = Object.prototype;
  var SymbolProto = typeof Symbol !== 'undefined' ? Symbol.prototype : null;

  // Create quick reference variables for speed access to core prototypes.
  var push = ArrayProto.push,
      slice = ArrayProto.slice,
      toString = ObjProto.toString,
      hasOwnProperty = ObjProto.hasOwnProperty;

  // All **ECMAScript 5** native function implementations that we hope to use
  // are declared here.
  var nativeIsArray = Array.isArray,
      nativeKeys = Object.keys,
      nativeCreate = Object.create;

  // Naked function reference for surrogate-prototype-swapping.
  var Ctor = function(){};

  // Create a safe reference to the Underscore object for use below.
  var _ = function(obj) {
    if (obj instanceof _) return obj;
    if (!(this instanceof _)) return new _(obj);
    this._wrapped = obj;
  };

  // Export the Underscore object for **Node.js**, with
  // backwards-compatibility for their old module API. If we're in
  // the browser, add `_` as a global object.
  // (`nodeType` is checked to ensure that `module`
  // and `exports` are not HTML elements.)
  if (typeof exports != 'undefined' && !exports.nodeType) {
    if (typeof module != 'undefined' && !module.nodeType && module.exports) {
      exports = module.exports = _;
    }
    exports._ = _;
  } else {
    root._ = _;
  }

  // Current version.
  _.VERSION = '1.9.0';

  // Internal function that returns an efficient (for current engines) version
  // of the passed-in callback, to be repeatedly applied in other Underscore
  // functions.
  var optimizeCb = function(func, context, argCount) {
    if (context === void 0) return func;
    switch (argCount == null ? 3 : argCount) {
      case 1: return function(value) {
        return func.call(context, value);
      };
      // The 2-argument case is omitted because we’re not using it.
      case 3: return function(value, index, collection) {
        return func.call(context, value, index, collection);
      };
      case 4: return function(accumulator, value, index, collection) {
        return func.call(context, accumulator, value, index, collection);
      };
    }
    return function() {
      return func.apply(context, arguments);
    };
  };

  var builtinIteratee;

  // An internal function to generate callbacks that can be applied to each
  // element in a collection, returning the desired result — either `identity`,
  // an arbitrary callback, a property matcher, or a property accessor.
  var cb = function(value, context, argCount) {
    if (_.iteratee !== builtinIteratee) return _.iteratee(value, context);
    if (value == null) return _.identity;
    if (_.isFunction(value)) return optimizeCb(value, context, argCount);
    if (_.isObject(value) && !_.isArray(value)) return _.matcher(value);
    return _.property(value);
  };

  // External wrapper for our callback generator. Users may customize
  // `_.iteratee` if they want additional predicate/iteratee shorthand styles.
  // This abstraction hides the internal-only argCount argument.
  _.iteratee = builtinIteratee = function(value, context) {
    return cb(value, context, Infinity);
  };

  // Some functions take a variable number of arguments, or a few expected
  // arguments at the beginning and then a variable number of values to operate
  // on. This helper accumulates all remaining arguments past the function’s
  // argument length (or an explicit `startIndex`), into an array that becomes
  // the last argument. Similar to ES6’s "rest parameter".
  var restArguments = function(func, startIndex) {
    startIndex = startIndex == null ? func.length - 1 : +startIndex;
    return function() {
      var length = Math.max(arguments.length - startIndex, 0),
          rest = Array(length),
          index = 0;
      for (; index < length; index++) {
        rest[index] = arguments[index + startIndex];
      }
      switch (startIndex) {
        case 0: return func.call(this, rest);
        case 1: return func.call(this, arguments[0], rest);
        case 2: return func.call(this, arguments[0], arguments[1], rest);
      }
      var args = Array(startIndex + 1);
      for (index = 0; index < startIndex; index++) {
        args[index] = arguments[index];
      }
      args[startIndex] = rest;
      return func.apply(this, args);
    };
  };

  // An internal function for creating a new object that inherits from another.
  var baseCreate = function(prototype) {
    if (!_.isObject(prototype)) return {};
    if (nativeCreate) return nativeCreate(prototype);
    Ctor.prototype = prototype;
    var result = new Ctor;
    Ctor.prototype = null;
    return result;
  };

  var shallowProperty = function(key) {
    return function(obj) {
      return obj == null ? void 0 : obj[key];
    };
  };

  var deepGet = function(obj, path) {
    var length = path.length;
    for (var i = 0; i < length; i++) {
      if (obj == null) return void 0;
      obj = obj[path[i]];
    }
    return length ? obj : void 0;
  };

  // Helper for collection methods to determine whether a collection
  // should be iterated as an array or as an object.
  // Related: http://people.mozilla.org/~jorendorff/es6-draft.html#sec-tolength
  // Avoids a very nasty iOS 8 JIT bug on ARM-64. #2094
  var MAX_ARRAY_INDEX = Math.pow(2, 53) - 1;
  var getLength = shallowProperty('length');
  var isArrayLike = function(collection) {
    var length = getLength(collection);
    return typeof length == 'number' && length >= 0 && length <= MAX_ARRAY_INDEX;
  };

  // Collection Functions
  // --------------------

  // The cornerstone, an `each` implementation, aka `forEach`.
  // Handles raw objects in addition to array-likes. Treats all
  // sparse array-likes as if they were dense.
  _.each = _.forEach = function(obj, iteratee, context) {
    iteratee = optimizeCb(iteratee, context);
    var i, length;
    if (isArrayLike(obj)) {
      for (i = 0, length = obj.length; i < length; i++) {
        iteratee(obj[i], i, obj);
      }
    } else {
      var keys = _.keys(obj);
      for (i = 0, length = keys.length; i < length; i++) {
        iteratee(obj[keys[i]], keys[i], obj);
      }
    }
    return obj;
  };

  // Return the results of applying the iteratee to each element.
  _.map = _.collect = function(obj, iteratee, context) {
    iteratee = cb(iteratee, context);
    var keys = !isArrayLike(obj) && _.keys(obj),
        length = (keys || obj).length,
        results = Array(length);
    for (var index = 0; index < length; index++) {
      var currentKey = keys ? keys[index] : index;
      results[index] = iteratee(obj[currentKey], currentKey, obj);
    }
    return results;
  };

  // Create a reducing function iterating left or right.
  var createReduce = function(dir) {
    // Wrap code that reassigns argument variables in a separate function than
    // the one that accesses `arguments.length` to avoid a perf hit. (#1991)
    var reducer = function(obj, iteratee, memo, initial) {
      var keys = !isArrayLike(obj) && _.keys(obj),
          length = (keys || obj).length,
          index = dir > 0 ? 0 : length - 1;
      if (!initial) {
        memo = obj[keys ? keys[index] : index];
        index += dir;
      }
      for (; index >= 0 && index < length; index += dir) {
        var currentKey = keys ? keys[index] : index;
        memo = iteratee(memo, obj[currentKey], currentKey, obj);
      }
      return memo;
    };

    return function(obj, iteratee, memo, context) {
      var initial = arguments.length >= 3;
      return reducer(obj, optimizeCb(iteratee, context, 4), memo, initial);
    };
  };

  // **Reduce** builds up a single result from a list of values, aka `inject`,
  // or `foldl`.
  _.reduce = _.foldl = _.inject = createReduce(1);

  // The right-associative version of reduce, also known as `foldr`.
  _.reduceRight = _.foldr = createReduce(-1);

  // Return the first value which passes a truth test. Aliased as `detect`.
  _.find = _.detect = function(obj, predicate, context) {
    var keyFinder = isArrayLike(obj) ? _.findIndex : _.findKey;
    var key = keyFinder(obj, predicate, context);
    if (key !== void 0 && key !== -1) return obj[key];
  };

  // Return all the elements that pass a truth test.
  // Aliased as `select`.
  _.filter = _.select = function(obj, predicate, context) {
    var results = [];
    predicate = cb(predicate, context);
    _.each(obj, function(value, index, list) {
      if (predicate(value, index, list)) results.push(value);
    });
    return results;
  };

  // Return all the elements for which a truth test fails.
  _.reject = function(obj, predicate, context) {
    return _.filter(obj, _.negate(cb(predicate)), context);
  };

  // Determine whether all of the elements match a truth test.
  // Aliased as `all`.
  _.every = _.all = function(obj, predicate, context) {
    predicate = cb(predicate, context);
    var keys = !isArrayLike(obj) && _.keys(obj),
        length = (keys || obj).length;
    for (var index = 0; index < length; index++) {
      var currentKey = keys ? keys[index] : index;
      if (!predicate(obj[currentKey], currentKey, obj)) return false;
    }
    return true;
  };

  // Determine if at least one element in the object matches a truth test.
  // Aliased as `any`.
  _.some = _.any = function(obj, predicate, context) {
    predicate = cb(predicate, context);
    var keys = !isArrayLike(obj) && _.keys(obj),
        length = (keys || obj).length;
    for (var index = 0; index < length; index++) {
      var currentKey = keys ? keys[index] : index;
      if (predicate(obj[currentKey], currentKey, obj)) return true;
    }
    return false;
  };

  // Determine if the array or object contains a given item (using `===`).
  // Aliased as `includes` and `include`.
  _.contains = _.includes = _.include = function(obj, item, fromIndex, guard) {
    if (!isArrayLike(obj)) obj = _.values(obj);
    if (typeof fromIndex != 'number' || guard) fromIndex = 0;
    return _.indexOf(obj, item, fromIndex) >= 0;
  };

  // Invoke a method (with arguments) on every item in a collection.
  _.invoke = restArguments(function(obj, path, args) {
    var contextPath, func;
    if (_.isFunction(path)) {
      func = path;
    } else if (_.isArray(path)) {
      contextPath = path.slice(0, -1);
      path = path[path.length - 1];
    }
    return _.map(obj, function(context) {
      var method = func;
      if (!method) {
        if (contextPath && contextPath.length) {
          context = deepGet(context, contextPath);
        }
        if (context == null) return void 0;
        method = context[path];
      }
      return method == null ? method : method.apply(context, args);
    });
  });

  // Convenience version of a common use case of `map`: fetching a property.
  _.pluck = function(obj, key) {
    return _.map(obj, _.property(key));
  };

  // Convenience version of a common use case of `filter`: selecting only objects
  // containing specific `key:value` pairs.
  _.where = function(obj, attrs) {
    return _.filter(obj, _.matcher(attrs));
  };

  // Convenience version of a common use case of `find`: getting the first object
  // containing specific `key:value` pairs.
  _.findWhere = function(obj, attrs) {
    return _.find(obj, _.matcher(attrs));
  };

  // Return the maximum element (or element-based computation).
  _.max = function(obj, iteratee, context) {
    var result = -Infinity, lastComputed = -Infinity,
        value, computed;
    if (iteratee == null || typeof iteratee == 'number' && typeof obj[0] != 'object' && obj != null) {
      obj = isArrayLike(obj) ? obj : _.values(obj);
      for (var i = 0, length = obj.length; i < length; i++) {
        value = obj[i];
        if (value != null && value > result) {
          result = value;
        }
      }
    } else {
      iteratee = cb(iteratee, context);
      _.each(obj, function(v, index, list) {
        computed = iteratee(v, index, list);
        if (computed > lastComputed || computed === -Infinity && result === -Infinity) {
          result = v;
          lastComputed = computed;
        }
      });
    }
    return result;
  };

  // Return the minimum element (or element-based computation).
  _.min = function(obj, iteratee, context) {
    var result = Infinity, lastComputed = Infinity,
        value, computed;
    if (iteratee == null || typeof iteratee == 'number' && typeof obj[0] != 'object' && obj != null) {
      obj = isArrayLike(obj) ? obj : _.values(obj);
      for (var i = 0, length = obj.length; i < length; i++) {
        value = obj[i];
        if (value != null && value < result) {
          result = value;
        }
      }
    } else {
      iteratee = cb(iteratee, context);
      _.each(obj, function(v, index, list) {
        computed = iteratee(v, index, list);
        if (computed < lastComputed || computed === Infinity && result === Infinity) {
          result = v;
          lastComputed = computed;
        }
      });
    }
    return result;
  };

  // Shuffle a collection.
  _.shuffle = function(obj) {
    return _.sample(obj, Infinity);
  };

  // Sample **n** random values from a collection using the modern version of the
  // [Fisher-Yates shuffle](http://en.wikipedia.org/wiki/Fisher–Yates_shuffle).
  // If **n** is not specified, returns a single random element.
  // The internal `guard` argument allows it to work with `map`.
  _.sample = function(obj, n, guard) {
    if (n == null || guard) {
      if (!isArrayLike(obj)) obj = _.values(obj);
      return obj[_.random(obj.length - 1)];
    }
    var sample = isArrayLike(obj) ? _.clone(obj) : _.values(obj);
    var length = getLength(sample);
    n = Math.max(Math.min(n, length), 0);
    var last = length - 1;
    for (var index = 0; index < n; index++) {
      var rand = _.random(index, last);
      var temp = sample[index];
      sample[index] = sample[rand];
      sample[rand] = temp;
    }
    return sample.slice(0, n);
  };

  // Sort the object's values by a criterion produced by an iteratee.
  _.sortBy = function(obj, iteratee, context) {
    var index = 0;
    iteratee = cb(iteratee, context);
    return _.pluck(_.map(obj, function(value, key, list) {
      return {
        value: value,
        index: index++,
        criteria: iteratee(value, key, list)
      };
    }).sort(function(left, right) {
      var a = left.criteria;
      var b = right.criteria;
      if (a !== b) {
        if (a > b || a === void 0) return 1;
        if (a < b || b === void 0) return -1;
      }
      return left.index - right.index;
    }), 'value');
  };

  // An internal function used for aggregate "group by" operations.
  var group = function(behavior, partition) {
    return function(obj, iteratee, context) {
      var result = partition ? [[], []] : {};
      iteratee = cb(iteratee, context);
      _.each(obj, function(value, index) {
        var key = iteratee(value, index, obj);
        behavior(result, value, key);
      });
      return result;
    };
  };

  // Groups the object's values by a criterion. Pass either a string attribute
  // to group by, or a function that returns the criterion.
  _.groupBy = group(function(result, value, key) {
    if (_.has(result, key)) result[key].push(value); else result[key] = [value];
  });

  // Indexes the object's values by a criterion, similar to `groupBy`, but for
  // when you know that your index values will be unique.
  _.indexBy = group(function(result, value, key) {
    result[key] = value;
  });

  // Counts instances of an object that group by a certain criterion. Pass
  // either a string attribute to count by, or a function that returns the
  // criterion.
  _.countBy = group(function(result, value, key) {
    if (_.has(result, key)) result[key]++; else result[key] = 1;
  });

  var reStrSymbol = /[^\ud800-\udfff]|[\ud800-\udbff][\udc00-\udfff]|[\ud800-\udfff]/g;
  // Safely create a real, live array from anything iterable.
  _.toArray = function(obj) {
    if (!obj) return [];
    if (_.isArray(obj)) return slice.call(obj);
    if (_.isString(obj)) {
      // Keep surrogate pair characters together
      return obj.match(reStrSymbol);
    }
    if (isArrayLike(obj)) return _.map(obj, _.identity);
    return _.values(obj);
  };

  // Return the number of elements in an object.
  _.size = function(obj) {
    if (obj == null) return 0;
    return isArrayLike(obj) ? obj.length : _.keys(obj).length;
  };

  // Split a collection into two arrays: one whose elements all satisfy the given
  // predicate, and one whose elements all do not satisfy the predicate.
  _.partition = group(function(result, value, pass) {
    result[pass ? 0 : 1].push(value);
  }, true);

  // Array Functions
  // ---------------

  // Get the first element of an array. Passing **n** will return the first N
  // values in the array. Aliased as `head` and `take`. The **guard** check
  // allows it to work with `_.map`.
  _.first = _.head = _.take = function(array, n, guard) {
    if (array == null || array.length < 1) return void 0;
    if (n == null || guard) return array[0];
    return _.initial(array, array.length - n);
  };

  // Returns everything but the last entry of the array. Especially useful on
  // the arguments object. Passing **n** will return all the values in
  // the array, excluding the last N.
  _.initial = function(array, n, guard) {
    return slice.call(array, 0, Math.max(0, array.length - (n == null || guard ? 1 : n)));
  };

  // Get the last element of an array. Passing **n** will return the last N
  // values in the array.
  _.last = function(array, n, guard) {
    if (array == null || array.length < 1) return void 0;
    if (n == null || guard) return array[array.length - 1];
    return _.rest(array, Math.max(0, array.length - n));
  };

  // Returns everything but the first entry of the array. Aliased as `tail` and `drop`.
  // Especially useful on the arguments object. Passing an **n** will return
  // the rest N values in the array.
  _.rest = _.tail = _.drop = function(array, n, guard) {
    return slice.call(array, n == null || guard ? 1 : n);
  };

  // Trim out all falsy values from an array.
  _.compact = function(array) {
    return _.filter(array, Boolean);
  };

  // Internal implementation of a recursive `flatten` function.
  var flatten = function(input, shallow, strict, output) {
    output = output || [];
    var idx = output.length;
    for (var i = 0, length = getLength(input); i < length; i++) {
      var value = input[i];
      if (isArrayLike(value) && (_.isArray(value) || _.isArguments(value))) {
        // Flatten current level of array or arguments object.
        if (shallow) {
          var j = 0, len = value.length;
          while (j < len) output[idx++] = value[j++];
        } else {
          flatten(value, shallow, strict, output);
          idx = output.length;
        }
      } else if (!strict) {
        output[idx++] = value;
      }
    }
    return output;
  };

  // Flatten out an array, either recursively (by default), or just one level.
  _.flatten = function(array, shallow) {
    return flatten(array, shallow, false);
  };

  // Return a version of the array that does not contain the specified value(s).
  _.without = restArguments(function(array, otherArrays) {
    return _.difference(array, otherArrays);
  });

  // Produce a duplicate-free version of the array. If the array has already
  // been sorted, you have the option of using a faster algorithm.
  // The faster algorithm will not work with an iteratee if the iteratee
  // is not a one-to-one function, so providing an iteratee will disable
  // the faster algorithm.
  // Aliased as `unique`.
  _.uniq = _.unique = function(array, isSorted, iteratee, context) {
    if (!_.isBoolean(isSorted)) {
      context = iteratee;
      iteratee = isSorted;
      isSorted = false;
    }
    if (iteratee != null) iteratee = cb(iteratee, context);
    var result = [];
    var seen = [];
    for (var i = 0, length = getLength(array); i < length; i++) {
      var value = array[i],
          computed = iteratee ? iteratee(value, i, array) : value;
      if (isSorted && !iteratee) {
        if (!i || seen !== computed) result.push(value);
        seen = computed;
      } else if (iteratee) {
        if (!_.contains(seen, computed)) {
          seen.push(computed);
          result.push(value);
        }
      } else if (!_.contains(result, value)) {
        result.push(value);
      }
    }
    return result;
  };

  // Produce an array that contains the union: each distinct element from all of
  // the passed-in arrays.
  _.union = restArguments(function(arrays) {
    return _.uniq(flatten(arrays, true, true));
  });

  // Produce an array that contains every item shared between all the
  // passed-in arrays.
  _.intersection = function(array) {
    var result = [];
    var argsLength = arguments.length;
    for (var i = 0, length = getLength(array); i < length; i++) {
      var item = array[i];
      if (_.contains(result, item)) continue;
      var j;
      for (j = 1; j < argsLength; j++) {
        if (!_.contains(arguments[j], item)) break;
      }
      if (j === argsLength) result.push(item);
    }
    return result;
  };

  // Take the difference between one array and a number of other arrays.
  // Only the elements present in just the first array will remain.
  _.difference = restArguments(function(array, rest) {
    rest = flatten(rest, true, true);
    return _.filter(array, function(value){
      return !_.contains(rest, value);
    });
  });

  // Complement of _.zip. Unzip accepts an array of arrays and groups
  // each array's elements on shared indices.
  _.unzip = function(array) {
    var length = array && _.max(array, getLength).length || 0;
    var result = Array(length);

    for (var index = 0; index < length; index++) {
      result[index] = _.pluck(array, index);
    }
    return result;
  };

  // Zip together multiple lists into a single array -- elements that share
  // an index go together.
  _.zip = restArguments(_.unzip);

  // Converts lists into objects. Pass either a single array of `[key, value]`
  // pairs, or two parallel arrays of the same length -- one of keys, and one of
  // the corresponding values. Passing by pairs is the reverse of _.pairs.
  _.object = function(list, values) {
    var result = {};
    for (var i = 0, length = getLength(list); i < length; i++) {
      if (values) {
        result[list[i]] = values[i];
      } else {
        result[list[i][0]] = list[i][1];
      }
    }
    return result;
  };

  // Generator function to create the findIndex and findLastIndex functions.
  var createPredicateIndexFinder = function(dir) {
    return function(array, predicate, context) {
      predicate = cb(predicate, context);
      var length = getLength(array);
      var index = dir > 0 ? 0 : length - 1;
      for (; index >= 0 && index < length; index += dir) {
        if (predicate(array[index], index, array)) return index;
      }
      return -1;
    };
  };

  // Returns the first index on an array-like that passes a predicate test.
  _.findIndex = createPredicateIndexFinder(1);
  _.findLastIndex = createPredicateIndexFinder(-1);

  // Use a comparator function to figure out the smallest index at which
  // an object should be inserted so as to maintain order. Uses binary search.
  _.sortedIndex = function(array, obj, iteratee, context) {
    iteratee = cb(iteratee, context, 1);
    var value = iteratee(obj);
    var low = 0, high = getLength(array);
    while (low < high) {
      var mid = Math.floor((low + high) / 2);
      if (iteratee(array[mid]) < value) low = mid + 1; else high = mid;
    }
    return low;
  };

  // Generator function to create the indexOf and lastIndexOf functions.
  var createIndexFinder = function(dir, predicateFind, sortedIndex) {
    return function(array, item, idx) {
      var i = 0, length = getLength(array);
      if (typeof idx == 'number') {
        if (dir > 0) {
          i = idx >= 0 ? idx : Math.max(idx + length, i);
        } else {
          length = idx >= 0 ? Math.min(idx + 1, length) : idx + length + 1;
        }
      } else if (sortedIndex && idx && length) {
        idx = sortedIndex(array, item);
        return array[idx] === item ? idx : -1;
      }
      if (item !== item) {
        idx = predicateFind(slice.call(array, i, length), _.isNaN);
        return idx >= 0 ? idx + i : -1;
      }
      for (idx = dir > 0 ? i : length - 1; idx >= 0 && idx < length; idx += dir) {
        if (array[idx] === item) return idx;
      }
      return -1;
    };
  };

  // Return the position of the first occurrence of an item in an array,
  // or -1 if the item is not included in the array.
  // If the array is large and already in sort order, pass `true`
  // for **isSorted** to use binary search.
  _.indexOf = createIndexFinder(1, _.findIndex, _.sortedIndex);
  _.lastIndexOf = createIndexFinder(-1, _.findLastIndex);

  // Generate an integer Array containing an arithmetic progression. A port of
  // the native Python `range()` function. See
  // [the Python documentation](http://docs.python.org/library/functions.html#range).
  _.range = function(start, stop, step) {
    if (stop == null) {
      stop = start || 0;
      start = 0;
    }
    if (!step) {
      step = stop < start ? -1 : 1;
    }

    var length = Math.max(Math.ceil((stop - start) / step), 0);
    var range = Array(length);

    for (var idx = 0; idx < length; idx++, start += step) {
      range[idx] = start;
    }

    return range;
  };

  // Chunk a single array into multiple arrays, each containing `count` or fewer
  // items.
  _.chunk = function(array, count) {
    if (count == null || count < 1) return [];
    var result = [];
    var i = 0, length = array.length;
    while (i < length) {
      result.push(slice.call(array, i, i += count));
    }
    return result;
  };

  // Function (ahem) Functions
  // ------------------

  // Determines whether to execute a function as a constructor
  // or a normal function with the provided arguments.
  var executeBound = function(sourceFunc, boundFunc, context, callingContext, args) {
    if (!(callingContext instanceof boundFunc)) return sourceFunc.apply(context, args);
    var self = baseCreate(sourceFunc.prototype);
    var result = sourceFunc.apply(self, args);
    if (_.isObject(result)) return result;
    return self;
  };

  // Create a function bound to a given object (assigning `this`, and arguments,
  // optionally). Delegates to **ECMAScript 5**'s native `Function.bind` if
  // available.
  _.bind = restArguments(function(func, context, args) {
    if (!_.isFunction(func)) throw new TypeError('Bind must be called on a function');
    var bound = restArguments(function(callArgs) {
      return executeBound(func, bound, context, this, args.concat(callArgs));
    });
    return bound;
  });

  // Partially apply a function by creating a version that has had some of its
  // arguments pre-filled, without changing its dynamic `this` context. _ acts
  // as a placeholder by default, allowing any combination of arguments to be
  // pre-filled. Set `_.partial.placeholder` for a custom placeholder argument.
  _.partial = restArguments(function(func, boundArgs) {
    var placeholder = _.partial.placeholder;
    var bound = function() {
      var position = 0, length = boundArgs.length;
      var args = Array(length);
      for (var i = 0; i < length; i++) {
        args[i] = boundArgs[i] === placeholder ? arguments[position++] : boundArgs[i];
      }
      while (position < arguments.length) args.push(arguments[position++]);
      return executeBound(func, bound, this, this, args);
    };
    return bound;
  });

  _.partial.placeholder = _;

  // Bind a number of an object's methods to that object. Remaining arguments
  // are the method names to be bound. Useful for ensuring that all callbacks
  // defined on an object belong to it.
  _.bindAll = restArguments(function(obj, keys) {
    keys = flatten(keys, false, false);
    var index = keys.length;
    if (index < 1) throw new Error('bindAll must be passed function names');
    while (index--) {
      var key = keys[index];
      obj[key] = _.bind(obj[key], obj);
    }
  });

  // Memoize an expensive function by storing its results.
  _.memoize = function(func, hasher) {
    var memoize = function(key) {
      var cache = memoize.cache;
      var address = '' + (hasher ? hasher.apply(this, arguments) : key);
      if (!_.has(cache, address)) cache[address] = func.apply(this, arguments);
      return cache[address];
    };
    memoize.cache = {};
    return memoize;
  };

  // Delays a function for the given number of milliseconds, and then calls
  // it with the arguments supplied.
  _.delay = restArguments(function(func, wait, args) {
    return setTimeout(function() {
      return func.apply(null, args);
    }, wait);
  });

  // Defers a function, scheduling it to run after the current call stack has
  // cleared.
  _.defer = _.partial(_.delay, _, 1);

  // Returns a function, that, when invoked, will only be triggered at most once
  // during a given window of time. Normally, the throttled function will run
  // as much as it can, without ever going more than once per `wait` duration;
  // but if you'd like to disable the execution on the leading edge, pass
  // `{leading: false}`. To disable execution on the trailing edge, ditto.
  _.throttle = function(func, wait, options) {
    var timeout, context, args, result;
    var previous = 0;
    if (!options) options = {};

    var later = function() {
      previous = options.leading === false ? 0 : _.now();
      timeout = null;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    };

    var throttled = function() {
      var now = _.now();
      if (!previous && options.leading === false) previous = now;
      var remaining = wait - (now - previous);
      context = this;
      args = arguments;
      if (remaining <= 0 || remaining > wait) {
        if (timeout) {
          clearTimeout(timeout);
          timeout = null;
        }
        previous = now;
        result = func.apply(context, args);
        if (!timeout) context = args = null;
      } else if (!timeout && options.trailing !== false) {
        timeout = setTimeout(later, remaining);
      }
      return result;
    };

    throttled.cancel = function() {
      clearTimeout(timeout);
      previous = 0;
      timeout = context = args = null;
    };

    return throttled;
  };

  // Returns a function, that, as long as it continues to be invoked, will not
  // be triggered. The function will be called after it stops being called for
  // N milliseconds. If `immediate` is passed, trigger the function on the
  // leading edge, instead of the trailing.
  _.debounce = function(func, wait, immediate) {
    var timeout, result;

    var later = function(context, args) {
      timeout = null;
      if (args) result = func.apply(context, args);
    };

    var debounced = restArguments(function(args) {
      if (timeout) clearTimeout(timeout);
      if (immediate) {
        var callNow = !timeout;
        timeout = setTimeout(later, wait);
        if (callNow) result = func.apply(this, args);
      } else {
        timeout = _.delay(later, wait, this, args);
      }

      return result;
    });

    debounced.cancel = function() {
      clearTimeout(timeout);
      timeout = null;
    };

    return debounced;
  };

  // Returns the first function passed as an argument to the second,
  // allowing you to adjust arguments, run code before and after, and
  // conditionally execute the original function.
  _.wrap = function(func, wrapper) {
    return _.partial(wrapper, func);
  };

  // Returns a negated version of the passed-in predicate.
  _.negate = function(predicate) {
    return function() {
      return !predicate.apply(this, arguments);
    };
  };

  // Returns a function that is the composition of a list of functions, each
  // consuming the return value of the function that follows.
  _.compose = function() {
    var args = arguments;
    var start = args.length - 1;
    return function() {
      var i = start;
      var result = args[start].apply(this, arguments);
      while (i--) result = args[i].call(this, result);
      return result;
    };
  };

  // Returns a function that will only be executed on and after the Nth call.
  _.after = function(times, func) {
    return function() {
      if (--times < 1) {
        return func.apply(this, arguments);
      }
    };
  };

  // Returns a function that will only be executed up to (but not including) the Nth call.
  _.before = function(times, func) {
    var memo;
    return function() {
      if (--times > 0) {
        memo = func.apply(this, arguments);
      }
      if (times <= 1) func = null;
      return memo;
    };
  };

  // Returns a function that will be executed at most one time, no matter how
  // often you call it. Useful for lazy initialization.
  _.once = _.partial(_.before, 2);

  _.restArguments = restArguments;

  // Object Functions
  // ----------------

  // Keys in IE < 9 that won't be iterated by `for key in ...` and thus missed.
  var hasEnumBug = !{toString: null}.propertyIsEnumerable('toString');
  var nonEnumerableProps = ['valueOf', 'isPrototypeOf', 'toString',
    'propertyIsEnumerable', 'hasOwnProperty', 'toLocaleString'];

  var collectNonEnumProps = function(obj, keys) {
    var nonEnumIdx = nonEnumerableProps.length;
    var constructor = obj.constructor;
    var proto = _.isFunction(constructor) && constructor.prototype || ObjProto;

    // Constructor is a special case.
    var prop = 'constructor';
    if (_.has(obj, prop) && !_.contains(keys, prop)) keys.push(prop);

    while (nonEnumIdx--) {
      prop = nonEnumerableProps[nonEnumIdx];
      if (prop in obj && obj[prop] !== proto[prop] && !_.contains(keys, prop)) {
        keys.push(prop);
      }
    }
  };

  // Retrieve the names of an object's own properties.
  // Delegates to **ECMAScript 5**'s native `Object.keys`.
  _.keys = function(obj) {
    if (!_.isObject(obj)) return [];
    if (nativeKeys) return nativeKeys(obj);
    var keys = [];
    for (var key in obj) if (_.has(obj, key)) keys.push(key);
    // Ahem, IE < 9.
    if (hasEnumBug) collectNonEnumProps(obj, keys);
    return keys;
  };

  // Retrieve all the property names of an object.
  _.allKeys = function(obj) {
    if (!_.isObject(obj)) return [];
    var keys = [];
    for (var key in obj) keys.push(key);
    // Ahem, IE < 9.
    if (hasEnumBug) collectNonEnumProps(obj, keys);
    return keys;
  };

  // Retrieve the values of an object's properties.
  _.values = function(obj) {
    var keys = _.keys(obj);
    var length = keys.length;
    var values = Array(length);
    for (var i = 0; i < length; i++) {
      values[i] = obj[keys[i]];
    }
    return values;
  };

  // Returns the results of applying the iteratee to each element of the object.
  // In contrast to _.map it returns an object.
  _.mapObject = function(obj, iteratee, context) {
    iteratee = cb(iteratee, context);
    var keys = _.keys(obj),
        length = keys.length,
        results = {};
    for (var index = 0; index < length; index++) {
      var currentKey = keys[index];
      results[currentKey] = iteratee(obj[currentKey], currentKey, obj);
    }
    return results;
  };

  // Convert an object into a list of `[key, value]` pairs.
  // The opposite of _.object.
  _.pairs = function(obj) {
    var keys = _.keys(obj);
    var length = keys.length;
    var pairs = Array(length);
    for (var i = 0; i < length; i++) {
      pairs[i] = [keys[i], obj[keys[i]]];
    }
    return pairs;
  };

  // Invert the keys and values of an object. The values must be serializable.
  _.invert = function(obj) {
    var result = {};
    var keys = _.keys(obj);
    for (var i = 0, length = keys.length; i < length; i++) {
      result[obj[keys[i]]] = keys[i];
    }
    return result;
  };

  // Return a sorted list of the function names available on the object.
  // Aliased as `methods`.
  _.functions = _.methods = function(obj) {
    var names = [];
    for (var key in obj) {
      if (_.isFunction(obj[key])) names.push(key);
    }
    return names.sort();
  };

  // An internal function for creating assigner functions.
  var createAssigner = function(keysFunc, defaults) {
    return function(obj) {
      var length = arguments.length;
      if (defaults) obj = Object(obj);
      if (length < 2 || obj == null) return obj;
      for (var index = 1; index < length; index++) {
        var source = arguments[index],
            keys = keysFunc(source),
            l = keys.length;
        for (var i = 0; i < l; i++) {
          var key = keys[i];
          if (!defaults || obj[key] === void 0) obj[key] = source[key];
        }
      }
      return obj;
    };
  };

  // Extend a given object with all the properties in passed-in object(s).
  _.extend = createAssigner(_.allKeys);

  // Assigns a given object with all the own properties in the passed-in object(s).
  // (https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/Object/assign)
  _.extendOwn = _.assign = createAssigner(_.keys);

  // Returns the first key on an object that passes a predicate test.
  _.findKey = function(obj, predicate, context) {
    predicate = cb(predicate, context);
    var keys = _.keys(obj), key;
    for (var i = 0, length = keys.length; i < length; i++) {
      key = keys[i];
      if (predicate(obj[key], key, obj)) return key;
    }
  };

  // Internal pick helper function to determine if `obj` has key `key`.
  var keyInObj = function(value, key, obj) {
    return key in obj;
  };

  // Return a copy of the object only containing the whitelisted properties.
  _.pick = restArguments(function(obj, keys) {
    var result = {}, iteratee = keys[0];
    if (obj == null) return result;
    if (_.isFunction(iteratee)) {
      if (keys.length > 1) iteratee = optimizeCb(iteratee, keys[1]);
      keys = _.allKeys(obj);
    } else {
      iteratee = keyInObj;
      keys = flatten(keys, false, false);
      obj = Object(obj);
    }
    for (var i = 0, length = keys.length; i < length; i++) {
      var key = keys[i];
      var value = obj[key];
      if (iteratee(value, key, obj)) result[key] = value;
    }
    return result;
  });

  // Return a copy of the object without the blacklisted properties.
  _.omit = restArguments(function(obj, keys) {
    var iteratee = keys[0], context;
    if (_.isFunction(iteratee)) {
      iteratee = _.negate(iteratee);
      if (keys.length > 1) context = keys[1];
    } else {
      keys = _.map(flatten(keys, false, false), String);
      iteratee = function(value, key) {
        return !_.contains(keys, key);
      };
    }
    return _.pick(obj, iteratee, context);
  });

  // Fill in a given object with default properties.
  _.defaults = createAssigner(_.allKeys, true);

  // Creates an object that inherits from the given prototype object.
  // If additional properties are provided then they will be added to the
  // created object.
  _.create = function(prototype, props) {
    var result = baseCreate(prototype);
    if (props) _.extendOwn(result, props);
    return result;
  };

  // Create a (shallow-cloned) duplicate of an object.
  _.clone = function(obj) {
    if (!_.isObject(obj)) return obj;
    return _.isArray(obj) ? obj.slice() : _.extend({}, obj);
  };

  // Invokes interceptor with the obj, and then returns obj.
  // The primary purpose of this method is to "tap into" a method chain, in
  // order to perform operations on intermediate results within the chain.
  _.tap = function(obj, interceptor) {
    interceptor(obj);
    return obj;
  };

  // Returns whether an object has a given set of `key:value` pairs.
  _.isMatch = function(object, attrs) {
    var keys = _.keys(attrs), length = keys.length;
    if (object == null) return !length;
    var obj = Object(object);
    for (var i = 0; i < length; i++) {
      var key = keys[i];
      if (attrs[key] !== obj[key] || !(key in obj)) return false;
    }
    return true;
  };


  // Internal recursive comparison function for `isEqual`.
  var eq, deepEq;
  eq = function(a, b, aStack, bStack) {
    // Identical objects are equal. `0 === -0`, but they aren't identical.
    // See the [Harmony `egal` proposal](http://wiki.ecmascript.org/doku.php?id=harmony:egal).
    if (a === b) return a !== 0 || 1 / a === 1 / b;
    // `null` or `undefined` only equal to itself (strict comparison).
    if (a == null || b == null) return false;
    // `NaN`s are equivalent, but non-reflexive.
    if (a !== a) return b !== b;
    // Exhaust primitive checks
    var type = typeof a;
    if (type !== 'function' && type !== 'object' && typeof b != 'object') return false;
    return deepEq(a, b, aStack, bStack);
  };

  // Internal recursive comparison function for `isEqual`.
  deepEq = function(a, b, aStack, bStack) {
    // Unwrap any wrapped objects.
    if (a instanceof _) a = a._wrapped;
    if (b instanceof _) b = b._wrapped;
    // Compare `[[Class]]` names.
    var className = toString.call(a);
    if (className !== toString.call(b)) return false;
    switch (className) {
      // Strings, numbers, regular expressions, dates, and booleans are compared by value.
      case '[object RegExp]':
      // RegExps are coerced to strings for comparison (Note: '' + /a/i === '/a/i')
      case '[object String]':
        // Primitives and their corresponding object wrappers are equivalent; thus, `"5"` is
        // equivalent to `new String("5")`.
        return '' + a === '' + b;
      case '[object Number]':
        // `NaN`s are equivalent, but non-reflexive.
        // Object(NaN) is equivalent to NaN.
        if (+a !== +a) return +b !== +b;
        // An `egal` comparison is performed for other numeric values.
        return +a === 0 ? 1 / +a === 1 / b : +a === +b;
      case '[object Date]':
      case '[object Boolean]':
        // Coerce dates and booleans to numeric primitive values. Dates are compared by their
        // millisecond representations. Note that invalid dates with millisecond representations
        // of `NaN` are not equivalent.
        return +a === +b;
      case '[object Symbol]':
        return SymbolProto.valueOf.call(a) === SymbolProto.valueOf.call(b);
    }

    var areArrays = className === '[object Array]';
    if (!areArrays) {
      if (typeof a != 'object' || typeof b != 'object') return false;

      // Objects with different constructors are not equivalent, but `Object`s or `Array`s
      // from different frames are.
      var aCtor = a.constructor, bCtor = b.constructor;
      if (aCtor !== bCtor && !(_.isFunction(aCtor) && aCtor instanceof aCtor &&
                               _.isFunction(bCtor) && bCtor instanceof bCtor)
                          && ('constructor' in a && 'constructor' in b)) {
        return false;
      }
    }
    // Assume equality for cyclic structures. The algorithm for detecting cyclic
    // structures is adapted from ES 5.1 section 15.12.3, abstract operation `JO`.

    // Initializing stack of traversed objects.
    // It's done here since we only need them for objects and arrays comparison.
    aStack = aStack || [];
    bStack = bStack || [];
    var length = aStack.length;
    while (length--) {
      // Linear search. Performance is inversely proportional to the number of
      // unique nested structures.
      if (aStack[length] === a) return bStack[length] === b;
    }

    // Add the first object to the stack of traversed objects.
    aStack.push(a);
    bStack.push(b);

    // Recursively compare objects and arrays.
    if (areArrays) {
      // Compare array lengths to determine if a deep comparison is necessary.
      length = a.length;
      if (length !== b.length) return false;
      // Deep compare the contents, ignoring non-numeric properties.
      while (length--) {
        if (!eq(a[length], b[length], aStack, bStack)) return false;
      }
    } else {
      // Deep compare objects.
      var keys = _.keys(a), key;
      length = keys.length;
      // Ensure that both objects contain the same number of properties before comparing deep equality.
      if (_.keys(b).length !== length) return false;
      while (length--) {
        // Deep compare each member
        key = keys[length];
        if (!(_.has(b, key) && eq(a[key], b[key], aStack, bStack))) return false;
      }
    }
    // Remove the first object from the stack of traversed objects.
    aStack.pop();
    bStack.pop();
    return true;
  };

  // Perform a deep comparison to check if two objects are equal.
  _.isEqual = function(a, b) {
    return eq(a, b);
  };

  // Is a given array, string, or object empty?
  // An "empty" object has no enumerable own-properties.
  _.isEmpty = function(obj) {
    if (obj == null) return true;
    if (isArrayLike(obj) && (_.isArray(obj) || _.isString(obj) || _.isArguments(obj))) return obj.length === 0;
    return _.keys(obj).length === 0;
  };

  // Is a given value a DOM element?
  _.isElement = function(obj) {
    return !!(obj && obj.nodeType === 1);
  };

  // Is a given value an array?
  // Delegates to ECMA5's native Array.isArray
  _.isArray = nativeIsArray || function(obj) {
    return toString.call(obj) === '[object Array]';
  };

  // Is a given variable an object?
  _.isObject = function(obj) {
    var type = typeof obj;
    return type === 'function' || type === 'object' && !!obj;
  };

  // Add some isType methods: isArguments, isFunction, isString, isNumber, isDate, isRegExp, isError, isMap, isWeakMap, isSet, isWeakSet.
  _.each(['Arguments', 'Function', 'String', 'Number', 'Date', 'RegExp', 'Error', 'Symbol', 'Map', 'WeakMap', 'Set', 'WeakSet'], function(name) {
    _['is' + name] = function(obj) {
      return toString.call(obj) === '[object ' + name + ']';
    };
  });

  // Define a fallback version of the method in browsers (ahem, IE < 9), where
  // there isn't any inspectable "Arguments" type.
  if (!_.isArguments(arguments)) {
    _.isArguments = function(obj) {
      return _.has(obj, 'callee');
    };
  }

  // Optimize `isFunction` if appropriate. Work around some typeof bugs in old v8,
  // IE 11 (#1621), Safari 8 (#1929), and PhantomJS (#2236).
  var nodelist = root.document && root.document.childNodes;
  if (typeof /./ != 'function' && typeof Int8Array != 'object' && typeof nodelist != 'function') {
    _.isFunction = function(obj) {
      return typeof obj == 'function' || false;
    };
  }

  // Is a given object a finite number?
  _.isFinite = function(obj) {
    return !_.isSymbol(obj) && isFinite(obj) && !isNaN(parseFloat(obj));
  };

  // Is the given value `NaN`?
  _.isNaN = function(obj) {
    return _.isNumber(obj) && isNaN(obj);
  };

  // Is a given value a boolean?
  _.isBoolean = function(obj) {
    return obj === true || obj === false || toString.call(obj) === '[object Boolean]';
  };

  // Is a given value equal to null?
  _.isNull = function(obj) {
    return obj === null;
  };

  // Is a given variable undefined?
  _.isUndefined = function(obj) {
    return obj === void 0;
  };

  // Shortcut function for checking if an object has a given property directly
  // on itself (in other words, not on a prototype).
  _.has = function(obj, path) {
    if (!_.isArray(path)) {
      return obj != null && hasOwnProperty.call(obj, path);
    }
    var length = path.length;
    for (var i = 0; i < length; i++) {
      var key = path[i];
      if (obj == null || !hasOwnProperty.call(obj, key)) {
        return false;
      }
      obj = obj[key];
    }
    return !!length;
  };

  // Utility Functions
  // -----------------

  // Run Underscore.js in *noConflict* mode, returning the `_` variable to its
  // previous owner. Returns a reference to the Underscore object.
  _.noConflict = function() {
    root._ = previousUnderscore;
    return this;
  };

  // Keep the identity function around for default iteratees.
  _.identity = function(value) {
    return value;
  };

  // Predicate-generating functions. Often useful outside of Underscore.
  _.constant = function(value) {
    return function() {
      return value;
    };
  };

  _.noop = function(){};

  // Creates a function that, when passed an object, will traverse that object’s
  // properties down the given `path`, specified as an array of keys or indexes.
  _.property = function(path) {
    if (!_.isArray(path)) {
      return shallowProperty(path);
    }
    return function(obj) {
      return deepGet(obj, path);
    };
  };

  // Generates a function for a given object that returns a given property.
  _.propertyOf = function(obj) {
    if (obj == null) {
      return function(){};
    }
    return function(path) {
      return !_.isArray(path) ? obj[path] : deepGet(obj, path);
    };
  };

  // Returns a predicate for checking whether an object has a given set of
  // `key:value` pairs.
  _.matcher = _.matches = function(attrs) {
    attrs = _.extendOwn({}, attrs);
    return function(obj) {
      return _.isMatch(obj, attrs);
    };
  };

  // Run a function **n** times.
  _.times = function(n, iteratee, context) {
    var accum = Array(Math.max(0, n));
    iteratee = optimizeCb(iteratee, context, 1);
    for (var i = 0; i < n; i++) accum[i] = iteratee(i);
    return accum;
  };

  // Return a random integer between min and max (inclusive).
  _.random = function(min, max) {
    if (max == null) {
      max = min;
      min = 0;
    }
    return min + Math.floor(Math.random() * (max - min + 1));
  };

  // A (possibly faster) way to get the current timestamp as an integer.
  _.now = Date.now || function() {
    return new Date().getTime();
  };

  // List of HTML entities for escaping.
  var escapeMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#x27;',
    '`': '&#x60;'
  };
  var unescapeMap = _.invert(escapeMap);

  // Functions for escaping and unescaping strings to/from HTML interpolation.
  var createEscaper = function(map) {
    var escaper = function(match) {
      return map[match];
    };
    // Regexes for identifying a key that needs to be escaped.
    var source = '(?:' + _.keys(map).join('|') + ')';
    var testRegexp = RegExp(source);
    var replaceRegexp = RegExp(source, 'g');
    return function(string) {
      string = string == null ? '' : '' + string;
      return testRegexp.test(string) ? string.replace(replaceRegexp, escaper) : string;
    };
  };
  _.escape = createEscaper(escapeMap);
  _.unescape = createEscaper(unescapeMap);

  // Traverses the children of `obj` along `path`. If a child is a function, it
  // is invoked with its parent as context. Returns the value of the final
  // child, or `fallback` if any child is undefined.
  _.result = function(obj, path, fallback) {
    if (!_.isArray(path)) path = [path];
    var length = path.length;
    if (!length) {
      return _.isFunction(fallback) ? fallback.call(obj) : fallback;
    }
    for (var i = 0; i < length; i++) {
      var prop = obj == null ? void 0 : obj[path[i]];
      if (prop === void 0) {
        prop = fallback;
        i = length; // Ensure we don't continue iterating.
      }
      obj = _.isFunction(prop) ? prop.call(obj) : prop;
    }
    return obj;
  };

  // Generate a unique integer id (unique within the entire client session).
  // Useful for temporary DOM ids.
  var idCounter = 0;
  _.uniqueId = function(prefix) {
    var id = ++idCounter + '';
    return prefix ? prefix + id : id;
  };

  // By default, Underscore uses ERB-style template delimiters, change the
  // following template settings to use alternative delimiters.
  _.templateSettings = {
    evaluate: /<%([\s\S]+?)%>/g,
    interpolate: /<%=([\s\S]+?)%>/g,
    escape: /<%-([\s\S]+?)%>/g
  };

  // When customizing `templateSettings`, if you don't want to define an
  // interpolation, evaluation or escaping regex, we need one that is
  // guaranteed not to match.
  var noMatch = /(.)^/;

  // Certain characters need to be escaped so that they can be put into a
  // string literal.
  var escapes = {
    "'": "'",
    '\\': '\\',
    '\r': 'r',
    '\n': 'n',
    '\u2028': 'u2028',
    '\u2029': 'u2029'
  };

  var escapeRegExp = /\\|'|\r|\n|\u2028|\u2029/g;

  var escapeChar = function(match) {
    return '\\' + escapes[match];
  };

  // JavaScript micro-templating, similar to John Resig's implementation.
  // Underscore templating handles arbitrary delimiters, preserves whitespace,
  // and correctly escapes quotes within interpolated code.
  // NB: `oldSettings` only exists for backwards compatibility.
  _.template = function(text, settings, oldSettings) {
    if (!settings && oldSettings) settings = oldSettings;
    settings = _.defaults({}, settings, _.templateSettings);

    // Combine delimiters into one regular expression via alternation.
    var matcher = RegExp([
      (settings.escape || noMatch).source,
      (settings.interpolate || noMatch).source,
      (settings.evaluate || noMatch).source
    ].join('|') + '|$', 'g');

    // Compile the template source, escaping string literals appropriately.
    var index = 0;
    var source = "__p+='";
    text.replace(matcher, function(match, escape, interpolate, evaluate, offset) {
      source += text.slice(index, offset).replace(escapeRegExp, escapeChar);
      index = offset + match.length;

      if (escape) {
        source += "'+\n((__t=(" + escape + "))==null?'':_.escape(__t))+\n'";
      } else if (interpolate) {
        source += "'+\n((__t=(" + interpolate + "))==null?'':__t)+\n'";
      } else if (evaluate) {
        source += "';\n" + evaluate + "\n__p+='";
      }

      // Adobe VMs need the match returned to produce the correct offset.
      return match;
    });
    source += "';\n";

    // If a variable is not specified, place data values in local scope.
    if (!settings.variable) source = 'with(obj||{}){\n' + source + '}\n';

    source = "var __t,__p='',__j=Array.prototype.join," +
      "print=function(){__p+=__j.call(arguments,'');};\n" +
      source + 'return __p;\n';

    var render;
    try {
      render = new Function(settings.variable || 'obj', '_', source);
    } catch (e) {
      e.source = source;
      throw e;
    }

    var template = function(data) {
      return render.call(this, data, _);
    };

    // Provide the compiled source as a convenience for precompilation.
    var argument = settings.variable || 'obj';
    template.source = 'function(' + argument + '){\n' + source + '}';

    return template;
  };

  // Add a "chain" function. Start chaining a wrapped Underscore object.
  _.chain = function(obj) {
    var instance = _(obj);
    instance._chain = true;
    return instance;
  };

  // OOP
  // ---------------
  // If Underscore is called as a function, it returns a wrapped object that
  // can be used OO-style. This wrapper holds altered versions of all the
  // underscore functions. Wrapped objects may be chained.

  // Helper function to continue chaining intermediate results.
  var chainResult = function(instance, obj) {
    return instance._chain ? _(obj).chain() : obj;
  };

  // Add your own custom functions to the Underscore object.
  _.mixin = function(obj) {
    _.each(_.functions(obj), function(name) {
      var func = _[name] = obj[name];
      _.prototype[name] = function() {
        var args = [this._wrapped];
        push.apply(args, arguments);
        return chainResult(this, func.apply(_, args));
      };
    });
    return _;
  };

  // Add all of the Underscore functions to the wrapper object.
  _.mixin(_);

  // Add all mutator Array functions to the wrapper.
  _.each(['pop', 'push', 'reverse', 'shift', 'sort', 'splice', 'unshift'], function(name) {
    var method = ArrayProto[name];
    _.prototype[name] = function() {
      var obj = this._wrapped;
      method.apply(obj, arguments);
      if ((name === 'shift' || name === 'splice') && obj.length === 0) delete obj[0];
      return chainResult(this, obj);
    };
  });

  // Add all accessor Array functions to the wrapper.
  _.each(['concat', 'join', 'slice'], function(name) {
    var method = ArrayProto[name];
    _.prototype[name] = function() {
      return chainResult(this, method.apply(this._wrapped, arguments));
    };
  });

  // Extracts the result from a wrapped and chained object.
  _.prototype.value = function() {
    return this._wrapped;
  };

  // Provide unwrapping proxy for some methods used in engine operations
  // such as arithmetic and JSON stringification.
  _.prototype.valueOf = _.prototype.toJSON = _.prototype.value;

  _.prototype.toString = function() {
    return String(this._wrapped);
  };

  // AMD registration happens at the end for compatibility with AMD loaders
  // that may not enforce next-turn semantics on modules. Even though general
  // practice for AMD registration is to be anonymous, underscore registers
  // as a named module because, like jQuery, it is a base library that is
  // popular enough to be bundled in a third party lib, but not be part of
  // an AMD load request. Those cases could generate an error when an
  // anonymous define() is called outside of a loader request.
  if (true) {
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function() {
      return _;
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  }
}());

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(21), __webpack_require__(22)(module)))

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(process) {/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

if (process.env.NODE_ENV !== 'production') {
  var REACT_ELEMENT_TYPE = (typeof Symbol === 'function' &&
    Symbol.for &&
    Symbol.for('react.element')) ||
    0xeac7;

  var isValidElement = function(object) {
    return typeof object === 'object' &&
      object !== null &&
      object.$$typeof === REACT_ELEMENT_TYPE;
  };

  // By explicitly using `prop-types` you are opting into new development behavior.
  // http://fb.me/prop-types-in-prod
  var throwOnDirectAccess = true;
  module.exports = __webpack_require__(25)(isValidElement, throwOnDirectAccess);
} else {
  // By explicitly using `prop-types` you are opting into new production behavior.
  // http://fb.me/prop-types-in-prod
  module.exports = __webpack_require__(28)();
}

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ }),
/* 4 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.ReactRouter;

/***/ }),
/* 5 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.Hooks;

/***/ }),
/* 6 */
/***/ (function(module, exports) {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ }),
/* 7 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.FormFieldSelection;

/***/ }),
/* 8 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.ReactStringReplace;

/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 * 
 */

function makeEmptyFunction(arg) {
  return function () {
    return arg;
  };
}

/**
 * This function accepts and discards inputs; it has no side effects. This is
 * primarily useful idiomatically for overridable function endpoints which
 * always need to be callable, since JS lacks a null-call idiom ala Cocoa.
 */
var emptyFunction = function emptyFunction() {};

emptyFunction.thatReturns = makeEmptyFunction;
emptyFunction.thatReturnsFalse = makeEmptyFunction(false);
emptyFunction.thatReturnsTrue = makeEmptyFunction(true);
emptyFunction.thatReturnsNull = makeEmptyFunction(null);
emptyFunction.thatReturnsThis = function () {
  return this;
};
emptyFunction.thatReturnsArgument = function (arg) {
  return arg;
};

module.exports = emptyFunction;

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(process) {/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 */



/**
 * Use invariant() to assert state which your program assumes to be true.
 *
 * Provide sprintf-style format (only %s is supported) and arguments
 * to provide information about what broke and what you were
 * expecting.
 *
 * The invariant message will be stripped in production, but the invariant
 * will remain to ensure logic does not differ in production.
 */

var validateFormat = function validateFormat(format) {};

if (process.env.NODE_ENV !== 'production') {
  validateFormat = function validateFormat(format) {
    if (format === undefined) {
      throw new Error('invariant requires an error message argument');
    }
  };
}

function invariant(condition, format, a, b, c, d, e, f) {
  validateFormat(format);

  if (!condition) {
    var error;
    if (format === undefined) {
      error = new Error('Minified exception occurred; use the non-minified dev environment ' + 'for the full error message and additional helpful warnings.');
    } else {
      var args = [a, b, c, d, e, f];
      var argIndex = 0;
      error = new Error(format.replace(/%s/g, function () {
        return args[argIndex++];
      }));
      error.name = 'Invariant Violation';
    }

    error.framesToPop = 1; // we don't care about invariant's own frame
    throw error;
  }
}

module.exports = invariant;
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */



var ReactPropTypesSecret = 'SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED';

module.exports = ReactPropTypesSecret;


/***/ }),
/* 12 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.Listing;

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(process) {/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 */



var emptyFunction = __webpack_require__(9);

/**
 * Similar to invariant but only logs a warning if the condition is not met.
 * This can be used to log issues in development environments in critical
 * paths. Removing the logging code for production environments will keep the
 * same logic and follow the same code paths.
 */

var warning = emptyFunction;

if (process.env.NODE_ENV !== 'production') {
  var printWarning = function printWarning(format) {
    for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      args[_key - 1] = arguments[_key];
    }

    var argIndex = 0;
    var message = 'Warning: ' + format.replace(/%s/g, function () {
      return args[argIndex++];
    });
    if (typeof console !== 'undefined') {
      console.error(message);
    }
    try {
      // --- Welcome to debugging React ---
      // This error was thrown as a convenience so that you can use this stack
      // to find the callsite that caused this warning to fire.
      throw new Error(message);
    } catch (x) {}
  };

  warning = function warning(condition, format) {
    if (format === undefined) {
      throw new Error('`warning(condition, format, ...args)` requires a warning ' + 'message argument');
    }

    if (format.indexOf('Failed Composite propType: ') === 0) {
      return; // Ignore CompositeComponent proptype check.
    }

    if (!condition) {
      for (var _len2 = arguments.length, args = Array(_len2 > 2 ? _len2 - 2 : 0), _key2 = 2; _key2 < _len2; _key2++) {
        args[_key2 - 2] = arguments[_key2];
      }

      printWarning.apply(undefined, [format].concat(args));
    }
  };
}

module.exports = warning;
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ }),
/* 14 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.AutomaticEmailsBreadcrumb;

/***/ }),
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _formFieldSelection = __webpack_require__(7);

var _formFieldSelection2 = _interopRequireDefault(_formFieldSelection);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var EventsList = function (_React$Component) {
  _inherits(EventsList, _React$Component);

  function EventsList(props) {
    _classCallCheck(this, EventsList);

    var _this = _possibleConstructorReturn(this, (EventsList.__proto__ || Object.getPrototypeOf(EventsList)).call(this, props));

    _this.handleEventChange = _this.handleEventChange.bind(_this);
    return _this;
  }

  _createClass(EventsList, [{
    key: 'getEventsList',
    value: function getEventsList() {
      // remove events that are not yet implemented (marked as "soon")
      var events = _underscore2.default.filter(this.props.events, function (event) {
        return !event.soon;
      });
      return _underscore2.default.map(events, function (event) {
        return { id: event.slug, name: event.title };
      });
    }
  }, {
    key: 'displayEventsList',
    value: function displayEventsList() {
      var _this2 = this;

      var props = {
        field: {
          id: 'events_list',
          selected: function selected() {
            return _this2.props.selectedEvent;
          },
          forceSelect2: true,
          values: this.getEventsList(),
          extendSelect2Options: {
            minimumResultsForSearch: Infinity
          }
        },
        disabled: this.props.disabled,
        onValueChange: this.handleEventChange
      };

      return _react2.default.createElement(_formFieldSelection2.default, props);
    }
  }, {
    key: 'handleEventChange',
    value: function handleEventChange(e) {
      if (this.props.onValueChange) {
        this.props.onValueChange({ eventSlug: e.target.value });
      }
    }
  }, {
    key: 'render',
    value: function render() {
      return _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(
          'div',
          { className: 'event-selection' },
          this.displayEventsList()
        )
      );
    }
  }]);

  return EventsList;
}(_react2.default.Component);

EventsList.propTypes = {
  events: _propTypes2.default.object.isRequired, // eslint-disable-line react/forbid-prop-types
  selectedEvent: _propTypes2.default.string.isRequired,
  disabled: _propTypes2.default.bool,
  onValueChange: _propTypes2.default.func
};

EventsList.defaultProps = {
  disabled: false,
  onValueChange: null
};

module.exports = EventsList;

/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _formFieldSelection = __webpack_require__(7);

var _formFieldSelection2 = _interopRequireDefault(_formFieldSelection);

var _formFieldText = __webpack_require__(41);

var _formFieldText2 = _interopRequireDefault(_formFieldText);

var _newsletterSchedulingCommonOptions = __webpack_require__(42);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var defaultAfterTimeType = 'immediate';
var defaultAfterTimeNumber = 1;
var defaultAfterTimeNumberInputFieldSize = 3;

var EventScheduling = function (_React$Component) {
  _inherits(EventScheduling, _React$Component);

  function EventScheduling(props) {
    _classCallCheck(this, EventScheduling);

    var _this = _possibleConstructorReturn(this, (EventScheduling.__proto__ || Object.getPrototypeOf(EventScheduling)).call(this, props));

    _this.handleChange = _this.handleChange.bind(_this);

    _this.state = {
      afterTimeType: _this.props.item.afterTimeType || defaultAfterTimeType,
      afterTimeNumber: _this.props.item.afterTimeNumber || defaultAfterTimeNumber
    };
    return _this;
  }

  _createClass(EventScheduling, [{
    key: 'displayAfterTimeNumberField',
    value: function displayAfterTimeNumberField() {
      if (this.state.afterTimeType === 'immediate') return null;

      var props = {
        field: {
          id: 'scheduling_time_duration',
          defaultValue: this.state.afterTimeNumber,
          size: this.props.afterTimeNumberSize
        },
        onValueChange: _underscore2.default.partial(this.handleChange, _underscore2.default, 'afterTimeNumber')
      };

      return _react2.default.createElement(_formFieldText2.default, props);
    }
  }, {
    key: 'displayAfterTimeTypeOptions',
    value: function displayAfterTimeTypeOptions() {
      var _this2 = this;

      var props = {
        field: {
          id: 'scheduling_time_interval',
          forceSelect2: true,
          values: _underscore2.default.map(_newsletterSchedulingCommonOptions.timeDelayValues, function (name, id) {
            return { name: name, id: id };
          }),
          extendSelect2Options: {
            minimumResultsForSearch: Infinity
          },
          selected: function selected() {
            return _this2.state.afterTimeType;
          }
        },
        onValueChange: _underscore2.default.partial(this.handleChange, _underscore2.default, 'afterTimeType')
      };

      return _react2.default.createElement(_formFieldSelection2.default, props);
    }
  }, {
    key: 'handleChange',
    value: function handleChange(e, property) {
      var value = property === 'afterTimeNumber' ? parseInt(e.target.value, 10) : e.target.value;
      var data = _defineProperty({}, property, value);
      this.setState(data, this.propagateChange(data));
    }
  }, {
    key: 'propagateChange',
    value: function propagateChange(data) {
      if (!this.props.onValueChange) return;

      this.props.onValueChange(data);
    }
  }, {
    key: 'render',
    value: function render() {
      return _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(
          'div',
          { className: 'event-scheduling-time-duration-selection' },
          this.displayAfterTimeNumberField()
        ),
        _react2.default.createElement(
          'div',
          { className: 'event-scheduling-time-interval-selection' },
          this.displayAfterTimeTypeOptions()
        )
      );
    }
  }]);

  return EventScheduling;
}(_react2.default.Component);

EventScheduling.propTypes = {
  item: _propTypes2.default.object.isRequired, // eslint-disable-line react/forbid-prop-types
  afterTimeNumberSize: _propTypes2.default.number,
  onValueChange: _propTypes2.default.func
};

EventScheduling.defaultProps = {
  afterTimeNumberSize: defaultAfterTimeNumberInputFieldSize,
  onValueChange: null
};

module.exports = EventScheduling;

/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _formFieldSelection = __webpack_require__(7);

var _formFieldSelection2 = _interopRequireDefault(_formFieldSelection);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var APIEndpoint = 'automatic_emails';

var EventOptions = function (_React$Component) {
  _inherits(EventOptions, _React$Component);

  _createClass(EventOptions, null, [{
    key: 'getEventOptionsValues',
    value: function getEventOptionsValues(eventOptions) {
      var values = eventOptions && eventOptions.values ? eventOptions.values : [];

      return values ? values.map(function (value) {
        return {
          id: value.id,
          name: value.name
        };
      }) : values;
    }
  }]);

  function EventOptions(props) {
    _classCallCheck(this, EventOptions);

    var _this = _possibleConstructorReturn(this, (EventOptions.__proto__ || Object.getPrototypeOf(EventOptions)).call(this, props));

    _this.handleEventOptionChange = _this.handleEventOptionChange.bind(_this);
    return _this;
  }

  _createClass(EventOptions, [{
    key: 'displayEventOptions',
    value: function displayEventOptions() {
      var _this2 = this;

      var eventOptions = this.props.eventOptions;


      if (!eventOptions) return eventOptions;

      var props = {
        field: {
          id: 'event_options_' + this.props.eventSlug,
          forceSelect2: true,
          resetSelect2OnUpdate: true,
          values: this.constructor.getEventOptionsValues(eventOptions),
          multiple: eventOptions.multiple || false,
          placeholder: eventOptions.placeholder || false,
          extendSelect2Options: {
            minimumResultsForSearch: Infinity
          },
          transformChangedValue: function transformChangedValue(value, valueTextPair) {
            return _underscore2.default.map(valueTextPair, function (data) {
              return { id: data.id, name: data.text };
            });
          },
          selected: function selected() {
            return _this2.props.selected;
          }
        },
        onValueChange: this.handleEventOptionChange
      };

      if (eventOptions.type === 'remote') {
        props.field = _underscore2.default.extend(props.field, {
          remoteQuery: {
            minimumInputLength: eventOptions.remoteQueryMinimumInputLength || null,
            endpoint: APIEndpoint,
            method: 'get_event_options',
            data: {
              filter: eventOptions.remoteQueryFilter || null,
              email_slug: this.props.emailSlug,
              event_slug: this.props.eventSlug
            }
          }
        });
      }

      return _react2.default.createElement(_formFieldSelection2.default, props);
    }
  }, {
    key: 'handleEventOptionChange',
    value: function handleEventOptionChange(e) {
      if (this.props.onValueChange) {
        this.props.onValueChange({ eventOptionValue: e.target.value });
      }
    }
  }, {
    key: 'render',
    value: function render() {
      return _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(
          'div',
          { className: 'event-option-selection' },
          this.displayEventOptions()
        )
      );
    }
  }]);

  return EventOptions;
}(_react2.default.Component);

EventOptions.propTypes = {
  selected: _propTypes2.default.array, // eslint-disable-line react/forbid-prop-types
  eventOptions: _propTypes2.default.object, // eslint-disable-line react/forbid-prop-types
  eventSlug: _propTypes2.default.string.isRequired,
  emailSlug: _propTypes2.default.string.isRequired,
  onValueChange: _propTypes2.default.func
};

EventOptions.defaultProps = {
  eventOptions: null,
  selected: [],
  onValueChange: null
};

module.exports = EventOptions;

/***/ }),
/* 18 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.ReactTooltip;

/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(20);
__webpack_require__(23);
__webpack_require__(34);
__webpack_require__(38);
module.exports = __webpack_require__(48);


/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _wpJsHooks = __webpack_require__(5);

var _wpJsHooks2 = _interopRequireDefault(_wpJsHooks);

var _reactStringReplace = __webpack_require__(8);

var _reactStringReplace2 = _interopRequireDefault(_reactStringReplace);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Track once per page load
var trackCampaignNameTyped = _underscore2.default.once(function () {
  return _mailpoet2.default.trackEvent('User has typed a GA campaign name', { 'MailPoet Premium version': window.mailpoet_premium_version });
});
var addGACampaignField = function addGACampaignField(fields) {
  var tipLink = 'http://beta.docs.mailpoet.com/article/187-track-your-newsletters-subscribers-in-google-analytics';
  var tip = (0, _reactStringReplace2.default)(_mailpoet2.default.I18n.t('gaCampaignTip'), /\[link\](.*?)\[\/link\]/g, function (match, i) {
    return _react2.default.createElement(
      'a',
      {
        key: i,
        href: tipLink,
        target: '_blank'
      },
      match
    );
  });
  fields.push({
    name: 'ga_campaign',
    label: _mailpoet2.default.I18n.t('gaCampaignLine'),
    tip: tip,
    type: 'text',
    onBeforeChange: trackCampaignNameTyped
  });
  return fields;
};
_wpJsHooks2.default.addFilter('mailpoet_newsletters_3rd_step_fields', addGACampaignField);

/***/ }),
/* 21 */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || Function("return this")() || (1,eval)("this");
} catch(e) {
	// This works if the window reference is available
	if(typeof window === "object")
		g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),
/* 22 */
/***/ (function(module, exports) {

module.exports = function(module) {
	if(!module.webpackPolyfill) {
		module.deprecate = function() {};
		module.paths = [];
		// module.parent = undefined by default
		if(!module.children) module.children = [];
		Object.defineProperty(module, "loaded", {
			enumerable: true,
			get: function() {
				return module.l;
			}
		});
		Object.defineProperty(module, "id", {
			enumerable: true,
			get: function() {
				return module.i;
			}
		});
		module.webpackPolyfill = 1;
	}
	return module;
};


/***/ }),
/* 23 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _reactRouter = __webpack_require__(4);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _wpJsHooks = __webpack_require__(5);

var _wpJsHooks2 = _interopRequireDefault(_wpJsHooks);

var _page = __webpack_require__(24);

var _page2 = _interopRequireDefault(_page);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var addCampaignStatsRoute = function addCampaignStatsRoute(routes) {
  var updatedRoutes = routes;

  updatedRoutes.push({
    path: 'stats/:id(/)**',
    component: _page2.default
  });

  return updatedRoutes;
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_before_router', addCampaignStatsRoute);

var trackStatsClicked = function trackStatsClicked() {
  return _mailpoet2.default.trackEvent('User has clicked to view detailed stats', { 'MailPoet Premium version': window.mailpoet_premium_version });
};

var addCampaignStatsLink = function addCampaignStatsLink(params, newsletter) {
  var updatedParams = params;

  updatedParams.link = '/stats/' + newsletter.id;
  updatedParams.onClick = trackStatsClicked;

  return updatedParams;
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_listing_stats_before', addCampaignStatsLink);

var addStatisticsAction = function addStatisticsAction(actions) {
  var updatedActions = actions;

  updatedActions.unshift({
    name: 'stats',
    link: function link(newsletter) {
      return _react2.default.createElement(
        _reactRouter.Link,
        { to: '/stats/' + newsletter.id, onClick: trackStatsClicked },
        _mailpoet2.default.I18n.t('statsListingActionTitle')
      );
    },
    display: function display(newsletter) {
      // welcome emails provide explicit total_sent value
      var countProcessed = newsletter.queue && newsletter.queue.count_processed;

      return (parseInt(newsletter.total_sent, 10) || parseInt(countProcessed, 10)) > 0;
    }
  });

  return updatedActions;
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_listings_standard_actions', addStatisticsAction);
_wpJsHooks2.default.addFilter('mailpoet_newsletters_listings_welcome_notification_actions', addStatisticsAction);
_wpJsHooks2.default.addFilter('mailpoet_newsletters_listings_notification_history_actions', addStatisticsAction);

/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _reactRouter = __webpack_require__(4);

var _reactStringReplace = __webpack_require__(8);

var _reactStringReplace2 = _interopRequireDefault(_reactStringReplace);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

var _newsletter_stats = __webpack_require__(29);

var _newsletter_stats2 = _interopRequireDefault(_newsletter_stats);

var _newsletter_info = __webpack_require__(31);

var _newsletter_info2 = _interopRequireDefault(_newsletter_info);

var _clicked_links_table = __webpack_require__(32);

var _clicked_links_table2 = _interopRequireDefault(_clicked_links_table);

var _subscriber_engagement = __webpack_require__(33);

var _subscriber_engagement2 = _interopRequireDefault(_subscriber_engagement);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var CampaignStatsPage = function (_React$Component) {
  _inherits(CampaignStatsPage, _React$Component);

  function CampaignStatsPage(props) {
    _classCallCheck(this, CampaignStatsPage);

    var _this = _possibleConstructorReturn(this, (CampaignStatsPage.__proto__ || Object.getPrototypeOf(CampaignStatsPage)).call(this, props));

    _this.state = {
      item: {},
      loading: true,
      savingSegment: false,
      segmentCreated: false,
      segmentErrors: []
    };
    _this.handleCreateSegment = _this.handleCreateSegment.bind(_this);
    return _this;
  }

  _createClass(CampaignStatsPage, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      // Scroll to top in case we're coming
      // from the middle of a long newsletter listing
      window.scrollTo(0, 0);
      this.loadItem(this.props.params.id);
    }
  }, {
    key: 'componentWillReceiveProps',
    value: function componentWillReceiveProps(props) {
      if (this.props.params.id !== props.params.id) {
        this.loadItem(props.params.id);
      }
    }
  }, {
    key: 'handleCreateSegment',
    value: function handleCreateSegment(group, newsletter, linkId) {
      var _this2 = this;

      var name = newsletter.subject + ' \u2013 ' + group;
      this.setState({ savingSegment: true, segmentCreated: false, segmentErrors: [] });
      _mailpoet2.default.Ajax.post({
        api_version: window.mailpoet_api_version,
        endpoint: 'dynamic_segments',
        action: 'save',
        data: {
          segmentType: 'email',
          action: group === 'unopened' ? 'notOpened' : group,
          newsletter_id: newsletter.id,
          link_id: linkId,
          name: name
        }
      }).always(function () {
        _this2.setState({ savingSegment: false });
      }).done(function () {
        _this2.setState({
          segmentCreated: true,
          segmentName: name
        });
      }).fail(function (response) {
        _this2.setState({
          segmentErrors: response.errors.map(function (error) {
            return error.error === 409 ? _mailpoet2.default.I18n.t('segmentExists') : error.message;
          })
        });
      });
    }
  }, {
    key: 'loadItem',
    value: function loadItem(id) {
      var _this3 = this;

      this.setState({ loading: true });
      _mailpoet2.default.Modal.loading(true);

      _mailpoet2.default.Ajax.post({
        api_version: window.mailpoet_api_version,
        endpoint: 'stats',
        action: 'get',
        data: {
          id: id
        }
      }).always(function () {
        _mailpoet2.default.Modal.loading(false);
      }).done(function (response) {
        _this3.setState({
          loading: false,
          item: response.data
        });
      }).fail(function (response) {
        _mailpoet2.default.Notice.error(response.errors.map(function (error) {
          return error.message;
        }), { scroll: true });
        _this3.setState({
          loading: false,
          item: {}
        }, function () {
          _this3.context.router.push('/');
        });
      });
    }
  }, {
    key: 'renderCreateSegmentSuccess',
    value: function renderCreateSegmentSuccess() {
      var _this4 = this;

      var segmentCreatedSuccessMessage = void 0;

      if (this.state.segmentCreated) {
        var message = (0, _reactStringReplace2.default)(_mailpoet2.default.I18n.t('successMessage'), /\[link\](.*?)\[\/link\]/g, function (match, i) {
          return _react2.default.createElement(
            'a',
            {
              key: i,
              href: '?page=mailpoet-newsletters#/new'
            },
            match
          );
        });

        message = (0, _reactStringReplace2.default)(message, '%s', function () {
          return _this4.state.segmentName;
        });

        segmentCreatedSuccessMessage = _react2.default.createElement(
          'div',
          { className: 'mailpoet_notice notice inline notice-success' },
          _react2.default.createElement(
            'p',
            null,
            message
          )
        );
      }

      return segmentCreatedSuccessMessage;
    }
  }, {
    key: 'renderCreateSegmentError',
    value: function renderCreateSegmentError() {
      var error = void 0;

      if (this.state.segmentErrors.length > 0) {
        error = _react2.default.createElement(
          'div',
          null,
          this.state.segmentErrors.map(function (errorMessage) {
            return _react2.default.createElement(
              'div',
              { className: 'mailpoet_notice notice inline error', key: 'error-' + errorMessage },
              _react2.default.createElement(
                'p',
                null,
                errorMessage
              )
            );
          })
        );
      }

      return error;
    }
  }, {
    key: 'render',
    value: function render() {
      var newsletter = this.state.item;

      if (this.state.loading || !newsletter.queue) {
        return _react2.default.createElement(
          'div',
          null,
          _react2.default.createElement(
            'h1',
            { className: 'title' },
            _mailpoet2.default.I18n.t('statsTitle'),
            _react2.default.createElement(
              _reactRouter.Link,
              {
                className: 'page-title-action',
                to: '/'
              },
              _mailpoet2.default.I18n.t('backToList')
            )
          )
        );
      }

      return _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(
          'h1',
          { className: 'title' },
          _mailpoet2.default.I18n.t('statsTitle'),
          ': ',
          newsletter.subject,
          _react2.default.createElement(
            _reactRouter.Link,
            {
              className: 'page-title-action',
              to: '/'
            },
            _mailpoet2.default.I18n.t('backToList')
          )
        ),
        _react2.default.createElement(
          'div',
          { className: 'mailpoet_stat_triple-spaced' },
          _react2.default.createElement(
            'div',
            { style: { width: '40%', float: 'right' } },
            _react2.default.createElement(_newsletter_info2.default, { newsletter: newsletter })
          ),
          _react2.default.createElement(
            'div',
            { style: { width: '60%' } },
            _react2.default.createElement(_newsletter_stats2.default, { newsletter: newsletter })
          ),
          _react2.default.createElement('div', { style: { clear: 'both' } })
        ),
        _react2.default.createElement(
          'h2',
          null,
          _mailpoet2.default.I18n.t('clickedLinks')
        ),
        _react2.default.createElement(
          'div',
          { className: 'mailpoet_stat_triple-spaced' },
          _react2.default.createElement(_clicked_links_table2.default, { links: newsletter.clicked_links })
        ),
        _react2.default.createElement(
          'h2',
          null,
          _mailpoet2.default.I18n.t('subscriberEngagement')
        ),
        this.renderCreateSegmentSuccess(),
        this.renderCreateSegmentError(),
        _react2.default.createElement(_subscriber_engagement2.default, {
          location: this.props.location,
          params: this.props.params,
          newsletter: newsletter,
          handleCreateSegment: this.handleCreateSegment,
          savingSegment: this.state.savingSegment
        })
      );
    }
  }]);

  return CampaignStatsPage;
}(_react2.default.Component);

CampaignStatsPage.contextTypes = {
  router: _propTypes2.default.object.isRequired
};

CampaignStatsPage.propTypes = {
  params: _propTypes2.default.shape({
    id: _propTypes2.default.string.isRequired
  }).isRequired,
  location: _propTypes2.default.object.isRequired // eslint-disable-line react/forbid-prop-types
};

exports.default = CampaignStatsPage;

/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(process) {/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */



var emptyFunction = __webpack_require__(9);
var invariant = __webpack_require__(10);
var warning = __webpack_require__(13);
var assign = __webpack_require__(26);

var ReactPropTypesSecret = __webpack_require__(11);
var checkPropTypes = __webpack_require__(27);

module.exports = function(isValidElement, throwOnDirectAccess) {
  /* global Symbol */
  var ITERATOR_SYMBOL = typeof Symbol === 'function' && Symbol.iterator;
  var FAUX_ITERATOR_SYMBOL = '@@iterator'; // Before Symbol spec.

  /**
   * Returns the iterator method function contained on the iterable object.
   *
   * Be sure to invoke the function with the iterable as context:
   *
   *     var iteratorFn = getIteratorFn(myIterable);
   *     if (iteratorFn) {
   *       var iterator = iteratorFn.call(myIterable);
   *       ...
   *     }
   *
   * @param {?object} maybeIterable
   * @return {?function}
   */
  function getIteratorFn(maybeIterable) {
    var iteratorFn = maybeIterable && (ITERATOR_SYMBOL && maybeIterable[ITERATOR_SYMBOL] || maybeIterable[FAUX_ITERATOR_SYMBOL]);
    if (typeof iteratorFn === 'function') {
      return iteratorFn;
    }
  }

  /**
   * Collection of methods that allow declaration and validation of props that are
   * supplied to React components. Example usage:
   *
   *   var Props = require('ReactPropTypes');
   *   var MyArticle = React.createClass({
   *     propTypes: {
   *       // An optional string prop named "description".
   *       description: Props.string,
   *
   *       // A required enum prop named "category".
   *       category: Props.oneOf(['News','Photos']).isRequired,
   *
   *       // A prop named "dialog" that requires an instance of Dialog.
   *       dialog: Props.instanceOf(Dialog).isRequired
   *     },
   *     render: function() { ... }
   *   });
   *
   * A more formal specification of how these methods are used:
   *
   *   type := array|bool|func|object|number|string|oneOf([...])|instanceOf(...)
   *   decl := ReactPropTypes.{type}(.isRequired)?
   *
   * Each and every declaration produces a function with the same signature. This
   * allows the creation of custom validation functions. For example:
   *
   *  var MyLink = React.createClass({
   *    propTypes: {
   *      // An optional string or URI prop named "href".
   *      href: function(props, propName, componentName) {
   *        var propValue = props[propName];
   *        if (propValue != null && typeof propValue !== 'string' &&
   *            !(propValue instanceof URI)) {
   *          return new Error(
   *            'Expected a string or an URI for ' + propName + ' in ' +
   *            componentName
   *          );
   *        }
   *      }
   *    },
   *    render: function() {...}
   *  });
   *
   * @internal
   */

  var ANONYMOUS = '<<anonymous>>';

  // Important!
  // Keep this list in sync with production version in `./factoryWithThrowingShims.js`.
  var ReactPropTypes = {
    array: createPrimitiveTypeChecker('array'),
    bool: createPrimitiveTypeChecker('boolean'),
    func: createPrimitiveTypeChecker('function'),
    number: createPrimitiveTypeChecker('number'),
    object: createPrimitiveTypeChecker('object'),
    string: createPrimitiveTypeChecker('string'),
    symbol: createPrimitiveTypeChecker('symbol'),

    any: createAnyTypeChecker(),
    arrayOf: createArrayOfTypeChecker,
    element: createElementTypeChecker(),
    instanceOf: createInstanceTypeChecker,
    node: createNodeChecker(),
    objectOf: createObjectOfTypeChecker,
    oneOf: createEnumTypeChecker,
    oneOfType: createUnionTypeChecker,
    shape: createShapeTypeChecker,
    exact: createStrictShapeTypeChecker,
  };

  /**
   * inlined Object.is polyfill to avoid requiring consumers ship their own
   * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/is
   */
  /*eslint-disable no-self-compare*/
  function is(x, y) {
    // SameValue algorithm
    if (x === y) {
      // Steps 1-5, 7-10
      // Steps 6.b-6.e: +0 != -0
      return x !== 0 || 1 / x === 1 / y;
    } else {
      // Step 6.a: NaN == NaN
      return x !== x && y !== y;
    }
  }
  /*eslint-enable no-self-compare*/

  /**
   * We use an Error-like object for backward compatibility as people may call
   * PropTypes directly and inspect their output. However, we don't use real
   * Errors anymore. We don't inspect their stack anyway, and creating them
   * is prohibitively expensive if they are created too often, such as what
   * happens in oneOfType() for any type before the one that matched.
   */
  function PropTypeError(message) {
    this.message = message;
    this.stack = '';
  }
  // Make `instanceof Error` still work for returned errors.
  PropTypeError.prototype = Error.prototype;

  function createChainableTypeChecker(validate) {
    if (process.env.NODE_ENV !== 'production') {
      var manualPropTypeCallCache = {};
      var manualPropTypeWarningCount = 0;
    }
    function checkType(isRequired, props, propName, componentName, location, propFullName, secret) {
      componentName = componentName || ANONYMOUS;
      propFullName = propFullName || propName;

      if (secret !== ReactPropTypesSecret) {
        if (throwOnDirectAccess) {
          // New behavior only for users of `prop-types` package
          invariant(
            false,
            'Calling PropTypes validators directly is not supported by the `prop-types` package. ' +
            'Use `PropTypes.checkPropTypes()` to call them. ' +
            'Read more at http://fb.me/use-check-prop-types'
          );
        } else if (process.env.NODE_ENV !== 'production' && typeof console !== 'undefined') {
          // Old behavior for people using React.PropTypes
          var cacheKey = componentName + ':' + propName;
          if (
            !manualPropTypeCallCache[cacheKey] &&
            // Avoid spamming the console because they are often not actionable except for lib authors
            manualPropTypeWarningCount < 3
          ) {
            warning(
              false,
              'You are manually calling a React.PropTypes validation ' +
              'function for the `%s` prop on `%s`. This is deprecated ' +
              'and will throw in the standalone `prop-types` package. ' +
              'You may be seeing this warning due to a third-party PropTypes ' +
              'library. See https://fb.me/react-warning-dont-call-proptypes ' + 'for details.',
              propFullName,
              componentName
            );
            manualPropTypeCallCache[cacheKey] = true;
            manualPropTypeWarningCount++;
          }
        }
      }
      if (props[propName] == null) {
        if (isRequired) {
          if (props[propName] === null) {
            return new PropTypeError('The ' + location + ' `' + propFullName + '` is marked as required ' + ('in `' + componentName + '`, but its value is `null`.'));
          }
          return new PropTypeError('The ' + location + ' `' + propFullName + '` is marked as required in ' + ('`' + componentName + '`, but its value is `undefined`.'));
        }
        return null;
      } else {
        return validate(props, propName, componentName, location, propFullName);
      }
    }

    var chainedCheckType = checkType.bind(null, false);
    chainedCheckType.isRequired = checkType.bind(null, true);

    return chainedCheckType;
  }

  function createPrimitiveTypeChecker(expectedType) {
    function validate(props, propName, componentName, location, propFullName, secret) {
      var propValue = props[propName];
      var propType = getPropType(propValue);
      if (propType !== expectedType) {
        // `propValue` being instance of, say, date/regexp, pass the 'object'
        // check, but we can offer a more precise error message here rather than
        // 'of type `object`'.
        var preciseType = getPreciseType(propValue);

        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + preciseType + '` supplied to `' + componentName + '`, expected ') + ('`' + expectedType + '`.'));
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createAnyTypeChecker() {
    return createChainableTypeChecker(emptyFunction.thatReturnsNull);
  }

  function createArrayOfTypeChecker(typeChecker) {
    function validate(props, propName, componentName, location, propFullName) {
      if (typeof typeChecker !== 'function') {
        return new PropTypeError('Property `' + propFullName + '` of component `' + componentName + '` has invalid PropType notation inside arrayOf.');
      }
      var propValue = props[propName];
      if (!Array.isArray(propValue)) {
        var propType = getPropType(propValue);
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + propType + '` supplied to `' + componentName + '`, expected an array.'));
      }
      for (var i = 0; i < propValue.length; i++) {
        var error = typeChecker(propValue, i, componentName, location, propFullName + '[' + i + ']', ReactPropTypesSecret);
        if (error instanceof Error) {
          return error;
        }
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createElementTypeChecker() {
    function validate(props, propName, componentName, location, propFullName) {
      var propValue = props[propName];
      if (!isValidElement(propValue)) {
        var propType = getPropType(propValue);
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + propType + '` supplied to `' + componentName + '`, expected a single ReactElement.'));
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createInstanceTypeChecker(expectedClass) {
    function validate(props, propName, componentName, location, propFullName) {
      if (!(props[propName] instanceof expectedClass)) {
        var expectedClassName = expectedClass.name || ANONYMOUS;
        var actualClassName = getClassName(props[propName]);
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + actualClassName + '` supplied to `' + componentName + '`, expected ') + ('instance of `' + expectedClassName + '`.'));
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createEnumTypeChecker(expectedValues) {
    if (!Array.isArray(expectedValues)) {
      process.env.NODE_ENV !== 'production' ? warning(false, 'Invalid argument supplied to oneOf, expected an instance of array.') : void 0;
      return emptyFunction.thatReturnsNull;
    }

    function validate(props, propName, componentName, location, propFullName) {
      var propValue = props[propName];
      for (var i = 0; i < expectedValues.length; i++) {
        if (is(propValue, expectedValues[i])) {
          return null;
        }
      }

      var valuesString = JSON.stringify(expectedValues);
      return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of value `' + propValue + '` ' + ('supplied to `' + componentName + '`, expected one of ' + valuesString + '.'));
    }
    return createChainableTypeChecker(validate);
  }

  function createObjectOfTypeChecker(typeChecker) {
    function validate(props, propName, componentName, location, propFullName) {
      if (typeof typeChecker !== 'function') {
        return new PropTypeError('Property `' + propFullName + '` of component `' + componentName + '` has invalid PropType notation inside objectOf.');
      }
      var propValue = props[propName];
      var propType = getPropType(propValue);
      if (propType !== 'object') {
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + propType + '` supplied to `' + componentName + '`, expected an object.'));
      }
      for (var key in propValue) {
        if (propValue.hasOwnProperty(key)) {
          var error = typeChecker(propValue, key, componentName, location, propFullName + '.' + key, ReactPropTypesSecret);
          if (error instanceof Error) {
            return error;
          }
        }
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createUnionTypeChecker(arrayOfTypeCheckers) {
    if (!Array.isArray(arrayOfTypeCheckers)) {
      process.env.NODE_ENV !== 'production' ? warning(false, 'Invalid argument supplied to oneOfType, expected an instance of array.') : void 0;
      return emptyFunction.thatReturnsNull;
    }

    for (var i = 0; i < arrayOfTypeCheckers.length; i++) {
      var checker = arrayOfTypeCheckers[i];
      if (typeof checker !== 'function') {
        warning(
          false,
          'Invalid argument supplied to oneOfType. Expected an array of check functions, but ' +
          'received %s at index %s.',
          getPostfixForTypeWarning(checker),
          i
        );
        return emptyFunction.thatReturnsNull;
      }
    }

    function validate(props, propName, componentName, location, propFullName) {
      for (var i = 0; i < arrayOfTypeCheckers.length; i++) {
        var checker = arrayOfTypeCheckers[i];
        if (checker(props, propName, componentName, location, propFullName, ReactPropTypesSecret) == null) {
          return null;
        }
      }

      return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` supplied to ' + ('`' + componentName + '`.'));
    }
    return createChainableTypeChecker(validate);
  }

  function createNodeChecker() {
    function validate(props, propName, componentName, location, propFullName) {
      if (!isNode(props[propName])) {
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` supplied to ' + ('`' + componentName + '`, expected a ReactNode.'));
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createShapeTypeChecker(shapeTypes) {
    function validate(props, propName, componentName, location, propFullName) {
      var propValue = props[propName];
      var propType = getPropType(propValue);
      if (propType !== 'object') {
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type `' + propType + '` ' + ('supplied to `' + componentName + '`, expected `object`.'));
      }
      for (var key in shapeTypes) {
        var checker = shapeTypes[key];
        if (!checker) {
          continue;
        }
        var error = checker(propValue, key, componentName, location, propFullName + '.' + key, ReactPropTypesSecret);
        if (error) {
          return error;
        }
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createStrictShapeTypeChecker(shapeTypes) {
    function validate(props, propName, componentName, location, propFullName) {
      var propValue = props[propName];
      var propType = getPropType(propValue);
      if (propType !== 'object') {
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type `' + propType + '` ' + ('supplied to `' + componentName + '`, expected `object`.'));
      }
      // We need to check all keys in case some are required but missing from
      // props.
      var allKeys = assign({}, props[propName], shapeTypes);
      for (var key in allKeys) {
        var checker = shapeTypes[key];
        if (!checker) {
          return new PropTypeError(
            'Invalid ' + location + ' `' + propFullName + '` key `' + key + '` supplied to `' + componentName + '`.' +
            '\nBad object: ' + JSON.stringify(props[propName], null, '  ') +
            '\nValid keys: ' +  JSON.stringify(Object.keys(shapeTypes), null, '  ')
          );
        }
        var error = checker(propValue, key, componentName, location, propFullName + '.' + key, ReactPropTypesSecret);
        if (error) {
          return error;
        }
      }
      return null;
    }

    return createChainableTypeChecker(validate);
  }

  function isNode(propValue) {
    switch (typeof propValue) {
      case 'number':
      case 'string':
      case 'undefined':
        return true;
      case 'boolean':
        return !propValue;
      case 'object':
        if (Array.isArray(propValue)) {
          return propValue.every(isNode);
        }
        if (propValue === null || isValidElement(propValue)) {
          return true;
        }

        var iteratorFn = getIteratorFn(propValue);
        if (iteratorFn) {
          var iterator = iteratorFn.call(propValue);
          var step;
          if (iteratorFn !== propValue.entries) {
            while (!(step = iterator.next()).done) {
              if (!isNode(step.value)) {
                return false;
              }
            }
          } else {
            // Iterator will provide entry [k,v] tuples rather than values.
            while (!(step = iterator.next()).done) {
              var entry = step.value;
              if (entry) {
                if (!isNode(entry[1])) {
                  return false;
                }
              }
            }
          }
        } else {
          return false;
        }

        return true;
      default:
        return false;
    }
  }

  function isSymbol(propType, propValue) {
    // Native Symbol.
    if (propType === 'symbol') {
      return true;
    }

    // 19.4.3.5 Symbol.prototype[@@toStringTag] === 'Symbol'
    if (propValue['@@toStringTag'] === 'Symbol') {
      return true;
    }

    // Fallback for non-spec compliant Symbols which are polyfilled.
    if (typeof Symbol === 'function' && propValue instanceof Symbol) {
      return true;
    }

    return false;
  }

  // Equivalent of `typeof` but with special handling for array and regexp.
  function getPropType(propValue) {
    var propType = typeof propValue;
    if (Array.isArray(propValue)) {
      return 'array';
    }
    if (propValue instanceof RegExp) {
      // Old webkits (at least until Android 4.0) return 'function' rather than
      // 'object' for typeof a RegExp. We'll normalize this here so that /bla/
      // passes PropTypes.object.
      return 'object';
    }
    if (isSymbol(propType, propValue)) {
      return 'symbol';
    }
    return propType;
  }

  // This handles more types than `getPropType`. Only used for error messages.
  // See `createPrimitiveTypeChecker`.
  function getPreciseType(propValue) {
    if (typeof propValue === 'undefined' || propValue === null) {
      return '' + propValue;
    }
    var propType = getPropType(propValue);
    if (propType === 'object') {
      if (propValue instanceof Date) {
        return 'date';
      } else if (propValue instanceof RegExp) {
        return 'regexp';
      }
    }
    return propType;
  }

  // Returns a string that is postfixed to a warning about an invalid type.
  // For example, "undefined" or "of type array"
  function getPostfixForTypeWarning(value) {
    var type = getPreciseType(value);
    switch (type) {
      case 'array':
      case 'object':
        return 'an ' + type;
      case 'boolean':
      case 'date':
      case 'regexp':
        return 'a ' + type;
      default:
        return type;
    }
  }

  // Returns class name of the object, if any.
  function getClassName(propValue) {
    if (!propValue.constructor || !propValue.constructor.name) {
      return ANONYMOUS;
    }
    return propValue.constructor.name;
  }

  ReactPropTypes.checkPropTypes = checkPropTypes;
  ReactPropTypes.PropTypes = ReactPropTypes;

  return ReactPropTypes;
};

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ }),
/* 26 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/*
object-assign
(c) Sindre Sorhus
@license MIT
*/


/* eslint-disable no-unused-vars */
var getOwnPropertySymbols = Object.getOwnPropertySymbols;
var hasOwnProperty = Object.prototype.hasOwnProperty;
var propIsEnumerable = Object.prototype.propertyIsEnumerable;

function toObject(val) {
	if (val === null || val === undefined) {
		throw new TypeError('Object.assign cannot be called with null or undefined');
	}

	return Object(val);
}

function shouldUseNative() {
	try {
		if (!Object.assign) {
			return false;
		}

		// Detect buggy property enumeration order in older V8 versions.

		// https://bugs.chromium.org/p/v8/issues/detail?id=4118
		var test1 = new String('abc');  // eslint-disable-line no-new-wrappers
		test1[5] = 'de';
		if (Object.getOwnPropertyNames(test1)[0] === '5') {
			return false;
		}

		// https://bugs.chromium.org/p/v8/issues/detail?id=3056
		var test2 = {};
		for (var i = 0; i < 10; i++) {
			test2['_' + String.fromCharCode(i)] = i;
		}
		var order2 = Object.getOwnPropertyNames(test2).map(function (n) {
			return test2[n];
		});
		if (order2.join('') !== '0123456789') {
			return false;
		}

		// https://bugs.chromium.org/p/v8/issues/detail?id=3056
		var test3 = {};
		'abcdefghijklmnopqrst'.split('').forEach(function (letter) {
			test3[letter] = letter;
		});
		if (Object.keys(Object.assign({}, test3)).join('') !==
				'abcdefghijklmnopqrst') {
			return false;
		}

		return true;
	} catch (err) {
		// We don't expect any of the above to throw, but better to be safe.
		return false;
	}
}

module.exports = shouldUseNative() ? Object.assign : function (target, source) {
	var from;
	var to = toObject(target);
	var symbols;

	for (var s = 1; s < arguments.length; s++) {
		from = Object(arguments[s]);

		for (var key in from) {
			if (hasOwnProperty.call(from, key)) {
				to[key] = from[key];
			}
		}

		if (getOwnPropertySymbols) {
			symbols = getOwnPropertySymbols(from);
			for (var i = 0; i < symbols.length; i++) {
				if (propIsEnumerable.call(from, symbols[i])) {
					to[symbols[i]] = from[symbols[i]];
				}
			}
		}
	}

	return to;
};


/***/ }),
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(process) {/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */



if (process.env.NODE_ENV !== 'production') {
  var invariant = __webpack_require__(10);
  var warning = __webpack_require__(13);
  var ReactPropTypesSecret = __webpack_require__(11);
  var loggedTypeFailures = {};
}

/**
 * Assert that the values match with the type specs.
 * Error messages are memorized and will only be shown once.
 *
 * @param {object} typeSpecs Map of name to a ReactPropType
 * @param {object} values Runtime values that need to be type-checked
 * @param {string} location e.g. "prop", "context", "child context"
 * @param {string} componentName Name of the component for error messages.
 * @param {?Function} getStack Returns the component stack.
 * @private
 */
function checkPropTypes(typeSpecs, values, location, componentName, getStack) {
  if (process.env.NODE_ENV !== 'production') {
    for (var typeSpecName in typeSpecs) {
      if (typeSpecs.hasOwnProperty(typeSpecName)) {
        var error;
        // Prop type validation may throw. In case they do, we don't want to
        // fail the render phase where it didn't fail before. So we log it.
        // After these have been cleaned up, we'll let them throw.
        try {
          // This is intentionally an invariant that gets caught. It's the same
          // behavior as without this statement except with a better message.
          invariant(typeof typeSpecs[typeSpecName] === 'function', '%s: %s type `%s` is invalid; it must be a function, usually from ' + 'the `prop-types` package, but received `%s`.', componentName || 'React class', location, typeSpecName, typeof typeSpecs[typeSpecName]);
          error = typeSpecs[typeSpecName](values, typeSpecName, componentName, location, null, ReactPropTypesSecret);
        } catch (ex) {
          error = ex;
        }
        warning(!error || error instanceof Error, '%s: type specification of %s `%s` is invalid; the type checker ' + 'function must return `null` or an `Error` but returned a %s. ' + 'You may have forgotten to pass an argument to the type checker ' + 'creator (arrayOf, instanceOf, objectOf, oneOf, oneOfType, and ' + 'shape all require an argument).', componentName || 'React class', location, typeSpecName, typeof error);
        if (error instanceof Error && !(error.message in loggedTypeFailures)) {
          // Only monitor this failure once because there tends to be a lot of the
          // same error.
          loggedTypeFailures[error.message] = true;

          var stack = getStack ? getStack() : '';

          warning(false, 'Failed %s type: %s%s', location, error.message, stack != null ? stack : '');
        }
      }
    }
  }
}

module.exports = checkPropTypes;

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ }),
/* 28 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */



var emptyFunction = __webpack_require__(9);
var invariant = __webpack_require__(10);
var ReactPropTypesSecret = __webpack_require__(11);

module.exports = function() {
  function shim(props, propName, componentName, location, propFullName, secret) {
    if (secret === ReactPropTypesSecret) {
      // It is still safe when called from React.
      return;
    }
    invariant(
      false,
      'Calling PropTypes validators directly is not supported by the `prop-types` package. ' +
      'Use PropTypes.checkPropTypes() to call them. ' +
      'Read more at http://fb.me/use-check-prop-types'
    );
  };
  shim.isRequired = shim;
  function getShim() {
    return shim;
  };
  // Important!
  // Keep this list in sync with production version in `./factoryWithTypeCheckers.js`.
  var ReactPropTypes = {
    array: shim,
    bool: shim,
    func: shim,
    number: shim,
    object: shim,
    string: shim,
    symbol: shim,

    any: shim,
    arrayOf: getShim,
    element: shim,
    instanceOf: getShim,
    node: shim,
    objectOf: getShim,
    oneOf: getShim,
    oneOfType: getShim,
    shape: getShim,
    exact: getShim
  };

  ReactPropTypes.checkPropTypes = emptyFunction;
  ReactPropTypes.PropTypes = ReactPropTypes;

  return ReactPropTypes;
};


/***/ }),
/* 29 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _statsBadge = __webpack_require__(30);

var _statsBadge2 = _interopRequireDefault(_statsBadge);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var NewsletterGeneralStats = function NewsletterGeneralStats(_ref) {
  var newsletter = _ref.newsletter;

  var totalSent = newsletter.total_sent || 0;
  var percentageClicked = 0;
  var percentageOpened = 0;
  var percentageUnsubscribed = 0;
  if (totalSent > 0) {
    percentageClicked = newsletter.statistics.clicked * 100 / totalSent;
    percentageOpened = newsletter.statistics.opened * 100 / totalSent;
    percentageUnsubscribed = newsletter.statistics.unsubscribed * 100 / totalSent;
  }
  // format to 1 decimal place
  var percentageClickedDisplay = _mailpoet2.default.Num.toLocaleFixed(percentageClicked, 1);
  var percentageOpenedDisplay = _mailpoet2.default.Num.toLocaleFixed(percentageOpened, 1);
  var percentageUnsubscribedDisplay = _mailpoet2.default.Num.toLocaleFixed(percentageUnsubscribed, 1);
  var headlineOpened = percentageOpenedDisplay + '% ' + _mailpoet2.default.I18n.t('percentageOpened');
  var headlineClicked = percentageClickedDisplay + '% ' + _mailpoet2.default.I18n.t('percentageClicked');
  var headlineUnsubscribed = percentageUnsubscribedDisplay + '% ' + _mailpoet2.default.I18n.t('percentageUnsubscribed');
  var statsKBLink = 'http://beta.docs.mailpoet.com/article/190-whats-a-good-email-open-rate';
  // thresholds to display badges
  var minNewslettersSent = 20;
  var minNewslettersOpened = 5;
  var statsContent = void 0;
  if (totalSent >= minNewslettersSent && newsletter.statistics.opened >= minNewslettersOpened) {
    // display stats with badges
    statsContent = _react2.default.createElement(
      'div',
      { className: 'mailpoet_stat_grey' },
      _react2.default.createElement(
        'div',
        { className: 'mailpoet_stat_big mailpoet_stat_spaced' },
        _react2.default.createElement(_statsBadge2.default, {
          stat: 'opened',
          rate: percentageOpened,
          headline: headlineOpened
        })
      ),
      _react2.default.createElement(
        'div',
        { className: 'mailpoet_stat_big mailpoet_stat_spaced' },
        _react2.default.createElement(_statsBadge2.default, {
          stat: 'clicked',
          rate: percentageClicked,
          headline: headlineClicked
        })
      ),
      _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(_statsBadge2.default, {
          stat: 'unsubscribed',
          rate: percentageUnsubscribed,
          headline: headlineUnsubscribed
        })
      )
    );
  } else {
    // display stats without badges
    statsContent = _react2.default.createElement(
      'div',
      { className: 'mailpoet_stat_grey' },
      _react2.default.createElement(
        'div',
        { className: 'mailpoet_stat_big mailpoet_stat_spaced' },
        headlineOpened
      ),
      _react2.default.createElement(
        'div',
        { className: 'mailpoet_stat_big mailpoet_stat_spaced' },
        headlineClicked
      ),
      _react2.default.createElement(
        'div',
        null,
        headlineUnsubscribed
      )
    );
  }

  return _react2.default.createElement(
    'div',
    null,
    _react2.default.createElement(
      'p',
      { className: 'mailpoet_stat_grey mailpoet_stat_big' },
      _mailpoet2.default.I18n.t('statsTotalSent'),
      ' ',
      parseInt(totalSent, 10).toLocaleString()
    ),
    statsContent,
    newsletter.ga_campaign && _react2.default.createElement(
      'p',
      null,
      _mailpoet2.default.I18n.t('googleAnalytics'),
      ': ',
      newsletter.ga_campaign
    ),
    _react2.default.createElement(
      'p',
      null,
      _react2.default.createElement(
        'a',
        { href: statsKBLink, target: '_blank' },
        _mailpoet2.default.I18n.t('readMoreOnStats')
      )
    )
  );
};

NewsletterGeneralStats.propTypes = {
  newsletter: _propTypes2.default.shape({
    ga_campaign: _propTypes2.default.string,
    total_sent: _propTypes2.default.number,
    statistics: _propTypes2.default.shape({
      clicked: _propTypes2.default.string,
      opened: _propTypes2.default.string,
      unsubscribed: _propTypes2.default.string
    }).isRequired
  }).isRequired
};

exports.default = NewsletterGeneralStats;

/***/ }),
/* 30 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.StatsBadge;

/***/ }),
/* 31 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function formatAddress(address, name) {
  var addressString = '';
  if (address) {
    addressString = name ? name + ' <' + address + '>' : address;
  }
  return addressString;
}

function NewsletterStatsInfo(props) {
  var newsletter = props.newsletter;


  var newsletterDate = newsletter.queue.scheduled_at || newsletter.queue.created_at;

  var senderAddress = formatAddress(newsletter.sender_address || '', newsletter.sender_name || '');
  var replyToAddress = formatAddress(newsletter.reply_to_address || '', newsletter.reply_to_name || '');

  var segments = (newsletter.segments || []).map(function (segment) {
    return segment.name;
  }).join(', ');

  return _react2.default.createElement(
    'div',
    null,
    _react2.default.createElement(
      'div',
      { className: 'mailpoet_stat_spaced' },
      _react2.default.createElement(
        'a',
        { href: newsletter.preview_url, className: 'button-secondary', target: '_blank' },
        _mailpoet2.default.I18n.t('statsPreviewNewsletter')
      )
    ),
    _react2.default.createElement(
      'p',
      null,
      _mailpoet2.default.I18n.t('statsDateSent'),
      ': ',
      _mailpoet2.default.Date.format(newsletterDate)
    ),
    segments && _react2.default.createElement(
      'p',
      null,
      _mailpoet2.default.I18n.t('statsToSegments'),
      ': ',
      segments
    ),
    _react2.default.createElement(
      'p',
      null,
      _mailpoet2.default.I18n.t('statsFromAddress'),
      ': ',
      senderAddress
    ),
    replyToAddress && _react2.default.createElement(
      'p',
      null,
      _mailpoet2.default.I18n.t('statsReplyToAddress'),
      ': ',
      replyToAddress
    )
  );
}

NewsletterStatsInfo.propTypes = {
  newsletter: _propTypes2.default.shape({
    queue: _propTypes2.default.shape({
      scheduled_at: _propTypes2.default.string,
      created_at: _propTypes2.default.string
    }).isRequired,
    sender_address: _propTypes2.default.string,
    sender_name: _propTypes2.default.string,
    reply_to_address: _propTypes2.default.string,
    reply_to_name: _propTypes2.default.string,
    segments: _propTypes2.default.array
  }).isRequired
};

exports.default = NewsletterStatsInfo;

/***/ }),
/* 32 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mailpoetShortcodeLinks = window.mailpoet_shortcode_links;

function renderLink(url) {
  return mailpoetShortcodeLinks[url] ? mailpoetShortcodeLinks[url] : _react2.default.createElement(
    'a',
    { href: url, target: '_blank' },
    url
  );
}

function ClickedLinksTable(props) {
  var links = props.links;


  var content = void 0;
  if (links.length === 0) {
    content = _react2.default.createElement(
      'tr',
      { className: 'alternate' },
      _react2.default.createElement(
        'td',
        { colSpan: '2' },
        _mailpoet2.default.I18n.t('noClickedLinksFound')
      )
    );
  } else {
    content = links.map(function (row, index) {
      return _react2.default.createElement(
        'tr',
        {
          key: 'link-' + row.id,
          className: index % 2 === 1 ? 'alternate' : ''
        },
        _react2.default.createElement(
          'td',
          null,
          renderLink(row.url)
        ),
        _react2.default.createElement(
          'td',
          null,
          row.cnt
        )
      );
    });
  }

  return _react2.default.createElement(
    'table',
    { className: 'widefat' },
    _react2.default.createElement(
      'thead',
      null,
      _react2.default.createElement(
        'tr',
        null,
        _react2.default.createElement(
          'td',
          null,
          _mailpoet2.default.I18n.t('linkColumn')
        ),
        _react2.default.createElement(
          'td',
          null,
          _mailpoet2.default.I18n.t('uniqueClicksColumn')
        )
      )
    ),
    _react2.default.createElement(
      'tbody',
      null,
      content
    )
  );
}

ClickedLinksTable.propTypes = {
  links: _propTypes2.default.arrayOf(_propTypes2.default.shape({
    id: _propTypes2.default.string.isRequired,
    cnt: _propTypes2.default.string.isRequired,
    url: _propTypes2.default.string.isRequired
  })).isRequired
};

exports.default = ClickedLinksTable;

/***/ }),
/* 33 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _listing = __webpack_require__(12);

var _listing2 = _interopRequireDefault(_listing);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var mailpoetListingPerPage = window.mailpoet_listing_per_page;

var columns = [{
  name: 'email',
  label: _mailpoet2.default.I18n.t('subscriberColumn'),
  sortable: true
}, {
  name: 'status',
  label: _mailpoet2.default.I18n.t('statusColumn'),
  sortable: true
}, {
  name: 'created_at',
  label: _mailpoet2.default.I18n.t('dateAndTimeColumn'),
  sortable: true
}];

var messages = {
  onLoadingItems: function onLoadingItems() {
    return _mailpoet2.default.I18n.t('loadingEngagementItems');
  },
  onNoItemsFound: function onNoItemsFound() {
    return _mailpoet2.default.I18n.t('noEngagementItemsFound');
  }
};

// Track once per page load
var trackFilteredByClickedLinks = _underscore2.default.once(function () {
  return _mailpoet2.default.trackEvent('User has filtered subscribers by clicked links', { 'MailPoet Premium version': window.mailpoet_premium_version });
});

function getListingItemKey(item) {
  return 'item-' + item.id + '-' + item.status;
}

function renderStatItem(statistic) {
  var status = '';

  switch (statistic.status) {
    case 'opened':
      status = _mailpoet2.default.I18n.t('opened');
      break;

    case 'clicked':
      status = _mailpoet2.default.I18n.t('clicked');
      break;

    case 'unsubscribed':
      status = _mailpoet2.default.I18n.t('unsubscribed');
      break;

    case 'unopened':
      status = _mailpoet2.default.I18n.t('unopened');
      break;

    default:
      break;
  }

  return _react2.default.createElement(
    'div',
    null,
    _react2.default.createElement(
      'td',
      { className: 'manage-column column-primary has-row-actions' },
      _react2.default.createElement(
        'strong',
        null,
        _react2.default.createElement(
          'a',
          {
            className: 'row-title',
            href: statistic.subscriber_url
          },
          statistic.email
        )
      ),
      _react2.default.createElement(
        'p',
        { style: { margin: 0 } },
        statistic.first_name,
        ' ',
        statistic.last_name
      )
    ),
    _react2.default.createElement(
      'td',
      { className: 'column', 'data-colname': _mailpoet2.default.I18n.t('statusColumn') },
      status
    ),
    _react2.default.createElement(
      'td',
      { className: 'column-date', 'data-colname': _mailpoet2.default.I18n.t('dateAndTimeColumn') },
      _react2.default.createElement(
        'abbr',
        null,
        _mailpoet2.default.Date.format(statistic.created_at)
      )
    )
  );
}

var SubscriberEngagementListing = function (_React$Component) {
  _inherits(SubscriberEngagementListing, _React$Component);

  function SubscriberEngagementListing(props) {
    _classCallCheck(this, SubscriberEngagementListing);

    var _this = _possibleConstructorReturn(this, (SubscriberEngagementListing.__proto__ || Object.getPrototypeOf(SubscriberEngagementListing)).call(this, props));

    _this.renderCreateSegmentButton = _this.renderCreateSegmentButton.bind(_this);
    _this.handleCreateSegment = _this.handleCreateSegment.bind(_this);
    return _this;
  }

  _createClass(SubscriberEngagementListing, [{
    key: 'handleCreateSegment',
    value: function handleCreateSegment(group, newsletter, linkId) {
      this.props.handleCreateSegment(group, newsletter, linkId);
    }
  }, {
    key: 'renderCreateSegmentButton',
    value: function renderCreateSegmentButton(listingState) {
      if (['opened', 'clicked', 'unopened'].indexOf(listingState.group) !== -1) {
        return _react2.default.createElement('input', {
          onClick: _underscore2.default.partial(this.handleCreateSegment, listingState.group, this.props.newsletter, listingState.filter.link),
          type: 'submit',
          value: this.props.savingSegment ? _mailpoet2.default.I18n.t('savingSegment') : _mailpoet2.default.I18n.t('createSegment'),
          className: 'stats-create-segment button',
          disabled: this.props.savingSegment
        });
      }
      return undefined;
    }
  }, {
    key: 'render',
    value: function render() {
      return _react2.default.createElement(_listing2.default, {
        limit: mailpoetListingPerPage,
        location: this.props.location,
        params: this.props.params,
        endpoint: 'stats',
        base_url: 'stats/:id',
        onRenderItem: renderStatItem,
        getListingItemKey: getListingItemKey,
        onBeforeSelectFilter: trackFilteredByClickedLinks,
        columns: columns,
        messages: messages,
        sort_by: 'created_at',
        sort_order: 'desc',
        renderExtraActions: this.renderCreateSegmentButton
      });
    }
  }]);

  return SubscriberEngagementListing;
}(_react2.default.Component);

SubscriberEngagementListing.propTypes = {
  params: _propTypes2.default.shape({
    id: _propTypes2.default.string.isRequired
  }).isRequired,
  location: _propTypes2.default.object.isRequired, // eslint-disable-line react/forbid-prop-types
  handleCreateSegment: _propTypes2.default.func.isRequired,
  savingSegment: _propTypes2.default.bool.isRequired,
  newsletter: _propTypes2.default.shape({
    id: _propTypes2.default.string.isRequired,
    subject: _propTypes2.default.string.isRequired
  }).isRequired
};

exports.default = SubscriberEngagementListing;

/***/ }),
/* 34 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _welcome = __webpack_require__(35);

var _welcome2 = _interopRequireDefault(_welcome);

var _wpJsHooks = __webpack_require__(5);

var _wpJsHooks2 = _interopRequireDefault(_wpJsHooks);

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var addWelcomeNotificationNewsletterType = function addWelcomeNotificationNewsletterType(types, that) {
  return types.map(function (type) {
    var newsletterType = type;
    if (newsletterType.slug !== 'welcome') return newsletterType;
    var onClick = _underscore2.default.partial(that.setupNewsletter, type.slug);
    newsletterType.action = function () {
      return _react2.default.createElement(
        'span',
        {
          className: 'button button-primary',
          onClick: onClick,
          onKeyDown: function onKeyDown(event) {
            if (['keydown', 'keypress'].includes(event.type) && ['Enter', ' '].includes(event.key)) {
              event.preventDefault();
              onClick();
            }
          },
          role: 'button',
          tabIndex: 0
        },
        _mailpoet2.default.I18n.t('setUp')
      );
    }();
    return newsletterType;
  });
};
_wpJsHooks2.default.addFilter('mailpoet_newsletters_types', addWelcomeNotificationNewsletterType);
var addWelcomeNotificationNewsletterTypeRoute = function addWelcomeNotificationNewsletterTypeRoute(routes) {
  var updatedRoutes = routes;
  updatedRoutes.push({
    path: 'new/welcome',
    component: _welcome2.default
  });
  return updatedRoutes;
};
_wpJsHooks2.default.addFilter('mailpoet_newsletters_before_router', addWelcomeNotificationNewsletterTypeRoute);
var addListingsWelcomeNotificationAction = function addListingsWelcomeNotificationAction(actions) {
  var updatedActions = actions;
  updatedActions.push({
    name: 'duplicate',
    label: _mailpoet2.default.I18n.t('duplicate'),
    onClick: function onClick(newsletter, refresh) {
      return _mailpoet2.default.Ajax.post({
        api_version: window.mailpoet_api_version,
        endpoint: 'newsletters',
        action: 'duplicate',
        data: {
          id: newsletter.id
        }
      }).done(function (response) {
        _mailpoet2.default.Notice.success(_mailpoet2.default.I18n.t('newsletterDuplicated').replace('%$1s', response.data.subject));
        refresh();
      }).fail(function (response) {
        if (response.errors.length > 0) {
          _mailpoet2.default.Notice.error(response.errors.map(function (error) {
            return error.message;
          }), { scroll: true });
        }
      });
    }
  });
  return updatedActions;
};
_wpJsHooks2.default.addFilter('mailpoet_newsletters_listings_welcome_notification_actions', addListingsWelcomeNotificationAction);

/***/ }),
/* 35 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _newsletterWelcomeNotificationScheduling = __webpack_require__(36);

var _newsletterWelcomeNotificationScheduling2 = _interopRequireDefault(_newsletterWelcomeNotificationScheduling);

var _newsletterCreationBreadcrumb = __webpack_require__(37);

var _newsletterCreationBreadcrumb2 = _interopRequireDefault(_newsletterCreationBreadcrumb);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var field = {
  name: 'options',
  label: 'Event',
  type: 'reactComponent',
  component: _newsletterWelcomeNotificationScheduling2.default
};

var NewsletterWelcome = function (_React$Component) {
  _inherits(NewsletterWelcome, _React$Component);

  function NewsletterWelcome(props) {
    _classCallCheck(this, NewsletterWelcome);

    var _this = _possibleConstructorReturn(this, (NewsletterWelcome.__proto__ || Object.getPrototypeOf(NewsletterWelcome)).call(this, props));

    var availableSegments = window.mailpoet_segments || [];
    var defaultSegment = 1;
    availableSegments = availableSegments.filter(function (segment) {
      return segment.type === 'default';
    });

    if (_underscore2.default.size(availableSegments) > 0) {
      defaultSegment = _underscore2.default.first(availableSegments).id;
    }

    _this.state = {
      options: {
        event: 'segment',
        segment: defaultSegment,
        role: 'subscriber',
        afterTimeNumber: 1,
        afterTimeType: 'immediate'
      }
    };

    _this.handleValueChange = _this.handleValueChange.bind(_this);
    _this.handleNext = _this.handleNext.bind(_this);
    return _this;
  }

  _createClass(NewsletterWelcome, [{
    key: 'handleValueChange',
    value: function handleValueChange(event) {
      var state = this.state;

      state[event.target.name] = event.target.value;
      this.setState(state);
    }
  }, {
    key: 'handleNext',
    value: function handleNext() {
      var _this2 = this;

      _mailpoet2.default.Ajax.post({
        api_version: window.mailpoet_api_version,
        endpoint: 'newsletters',
        action: 'create',
        data: _underscore2.default.extend({}, this.state, {
          type: 'welcome',
          subject: _mailpoet2.default.I18n.t('draftNewsletterTitle')
        })
      }).done(function (response) {
        _this2.showTemplateSelection(response.data.id);
      }).fail(function (response) {
        if (response.errors.length > 0) {
          _mailpoet2.default.Notice.error(response.errors.map(function (error) {
            return error.message;
          }), { scroll: true });
        }
      });
    }
  }, {
    key: 'showTemplateSelection',
    value: function showTemplateSelection(newsletterId) {
      this.props.router.push('/template/' + newsletterId);
    }
  }, {
    key: 'render',
    value: function render() {
      return _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(
          'h1',
          null,
          _mailpoet2.default.I18n.t('welcomeNewsletterTypeTitle')
        ),
        _react2.default.createElement(_newsletterCreationBreadcrumb2.default, { step: 'type' }),
        _react2.default.createElement(
          'h3',
          null,
          _mailpoet2.default.I18n.t('selectEventToSendWelcomeEmail')
        ),
        _react2.default.createElement(_newsletterWelcomeNotificationScheduling2.default, {
          item: this.state,
          field: field,
          onValueChange: this.handleValueChange
        }),
        _react2.default.createElement(
          'p',
          { className: 'submit' },
          _react2.default.createElement('input', {
            className: 'button button-primary',
            type: 'button',
            onClick: this.handleNext,
            value: _mailpoet2.default.I18n.t('next')
          })
        )
      );
    }
  }]);

  return NewsletterWelcome;
}(_react2.default.Component);

NewsletterWelcome.propTypes = {
  router: _propTypes2.default.shape({
    push: _propTypes2.default.func.isRequired
  }).isRequired
};

exports.default = NewsletterWelcome;

/***/ }),
/* 36 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.NewsletterWelcomeNotificationScheduling;

/***/ }),
/* 37 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.NewsletterCreationBreadcrumb;

/***/ }),
/* 38 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _wpJsHooks = __webpack_require__(5);

var _wpJsHooks2 = _interopRequireDefault(_wpJsHooks);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _automaticEmailEventsList = __webpack_require__(39);

var _automaticEmailEventsList2 = _interopRequireDefault(_automaticEmailEventsList);

var _events_conditions = __webpack_require__(40);

var _events_conditions2 = _interopRequireDefault(_events_conditions);

var _automaticEmailsBreadcrumb = __webpack_require__(14);

var _automaticEmailsBreadcrumb2 = _interopRequireDefault(_automaticEmailsBreadcrumb);

var _send_event_conditions = __webpack_require__(43);

var _send_event_conditions2 = _interopRequireDefault(_send_event_conditions);

var _listings = __webpack_require__(44);

var _listings2 = _interopRequireDefault(_listings);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

var emails = window.mailpoet_premium_automatic_emails || [];
var newslettersContainer = document.getElementById('newsletters_container');

if (newslettersContainer && !_underscore2.default.isEmpty(emails)) {
  var addEmails = function addEmails(types, that) {
    // remove automatic emails declared in Free version if they are declared in Premium
    var existingTypes = _underscore2.default.reject(types, function (type) {
      return _underscore2.default.has(emails, type.slug);
    });
    var newTypes = _underscore2.default.map(emails, function (email) {
      var updatedEmail = email;
      var onClick = _underscore2.default.partial(that.setupNewsletter, email.slug);

      updatedEmail.action = function () {
        return _react2.default.createElement(
          'div',
          null,
          _react2.default.createElement(
            'span',
            {
              className: 'button button-primary',
              onClick: onClick,
              onKeyDown: function onKeyDown(event) {
                if (['keydown', 'keypress'].includes(event.type) && ['Enter', ' '].includes(event.key)) {
                  event.preventDefault();
                  onClick();
                }
              },
              role: 'button',
              tabIndex: 0
            },
            email.actionButtonTitle || _mailpoet2.default.I18n.t('setUp')
          )
        );
      }();

      return updatedEmail;
    });

    return [].concat(_toConsumableArray(existingTypes), _toConsumableArray(newTypes));
  };

  var addEmailsRoutes = function addEmailsRoutes(routes) {
    // remove routes declared in Free version if they are declared in Premium
    var existingRoutes = _underscore2.default.reject(routes, function (route) {
      return _underscore2.default.has(emails, route.name);
    });

    var emailsRoutes = [];
    var emailsEventsRoutes = [];
    var emailsListingsRoute = [];

    _underscore2.default.each(emails, function (email) {
      var events = email.events;


      if (_underscore2.default.isObject(events)) {
        _underscore2.default.each(events, function (event) {
          emailsEventsRoutes.push({
            path: 'new/' + email.slug + '/' + event.slug + '/conditions',
            name: event.slug,
            component: _events_conditions2.default,
            data: {
              email: email
            }
          });
        });
      }

      emailsRoutes.push({
        path: 'new/' + email.slug,
        name: email.slug,
        component: _automaticEmailEventsList2.default,
        data: {
          email: email
        }
      });

      emailsListingsRoute.push({
        path: email.slug + '(/)**',
        params: {
          tab: email.slug
        },
        component: _listings2.default
      });
    });

    return [].concat(_toConsumableArray(existingRoutes), emailsRoutes, emailsEventsRoutes, emailsListingsRoute);
  };

  _wpJsHooks2.default.addFilter('mailpoet_newsletters_types', addEmails);
  _wpJsHooks2.default.addFilter('mailpoet_newsletters_before_router', addEmailsRoutes);
}

var addListingsTabs = function addListingsTabs(tabs) {
  var listingsTabs = [];

  _underscore2.default.each(emails, function (email) {
    listingsTabs.push({
      name: email.slug,
      label: email.title,
      link: email.slug
    });
  });

  return [].concat(_toConsumableArray(tabs), listingsTabs);
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_listings_tabs', addListingsTabs);

var addTemplateSelectionBreadcrumb = function addTemplateSelectionBreadcrumb(defaultBreadcrumb, newsletterType, step) {
  return newsletterType === 'automatic' ? _react2.default.createElement(_automaticEmailsBreadcrumb2.default, { step: step }) : defaultBreadcrumb;
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_template_breadcrumb', addTemplateSelectionBreadcrumb);
_wpJsHooks2.default.addFilter('mailpoet_newsletters_editor_breadcrumb', addTemplateSelectionBreadcrumb);
_wpJsHooks2.default.addFilter('mailpoet_newsletters_send_breadcrumb', addTemplateSelectionBreadcrumb);

var extendNewsletterEditorConfig = function extendNewsletterEditorConfig(defaultConfig, newsletter) {
  if (newsletter.type !== 'automatic') return defaultConfig;

  var config = defaultConfig;

  return _mailpoet2.default.Ajax.post({
    api_version: window.mailpoet_api_version,
    endpoint: 'automatic_emails',
    action: 'get_event_shortcodes',
    data: {
      email_slug: newsletter.options.group,
      event_slug: newsletter.options.event
    }
  }).then(function (response) {
    if (!_underscore2.default.isObject(response) || !response.data) return config;
    config.shortcodes = _extends({}, config.shortcodes, response.data);
    return config;
  }).fail(function (pauseFailResponse) {
    if (pauseFailResponse.errors.length > 0) {
      _mailpoet2.default.Notice.error(pauseFailResponse.errors.map(function (error) {
        return error.message;
      }), { scroll: true, static: true });
    }
  });
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_editor_extend_config', extendNewsletterEditorConfig);

var configureSendPageOptions = function configureSendPageOptions(defaultFields, newsletter) {
  if (newsletter.type !== 'automatic') return defaultFields;

  var email = emails[newsletter.options.group];

  if (!email) return defaultFields;

  var emailOptions = newsletter.options;
  var fields = [{
    name: 'subject',
    label: _mailpoet2.default.I18n.t('subjectLine'),
    tip: _mailpoet2.default.I18n.t('subjectLineTip'),
    type: 'text',
    validation: {
      'data-parsley-required': true,
      'data-parsley-required-message': _mailpoet2.default.I18n.t('emptySubjectLineError')
    }
  }, {
    name: 'options',
    label: _mailpoet2.default.I18n.t('sendAutomaticEmailWhenHeading').replace('%1s', email.title),
    type: 'reactComponent',
    component: _send_event_conditions2.default,
    email: email,
    emailOptions: emailOptions
  }, {
    name: 'sender',
    label: _mailpoet2.default.I18n.t('sender'),
    tip: _mailpoet2.default.I18n.t('senderTip'),
    fields: [{
      name: 'sender_name',
      type: 'text',
      placeholder: _mailpoet2.default.I18n.t('senderNamePlaceholder'),
      validation: {
        'data-parsley-required': true
      }
    }, {
      name: 'sender_address',
      type: 'text',
      placeholder: _mailpoet2.default.I18n.t('senderAddressPlaceholder'),
      validation: {
        'data-parsley-required': true,
        'data-parsley-type': 'email'
      }
    }]
  }, {
    name: 'reply-to',
    label: _mailpoet2.default.I18n.t('replyTo'),
    tip: _mailpoet2.default.I18n.t('replyToTip'),
    inline: true,
    fields: [{
      name: 'reply_to_name',
      type: 'text',
      placeholder: _mailpoet2.default.I18n.t('replyToNamePlaceholder')
    }, {
      name: 'reply_to_address',
      type: 'text',
      placeholder: _mailpoet2.default.I18n.t('replyToAddressPlaceholder'),
      validation: {
        'data-parsley-type': 'email'
      }
    }]
  }];

  return {
    getFields: function getFields() {
      return fields;
    },
    getSendButtonOptions: function getSendButtonOptions() {
      return {
        value: _mailpoet2.default.I18n.t('activate')
      };
    }
  };
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_send_newsletter_fields', configureSendPageOptions);

var configureSendPageServerRequest = function configureSendPageServerRequest(defaultParameters, newsletter) {
  return newsletter.type === 'automatic' ? {
    api_version: window.mailpoet_api_version,
    endpoint: 'newsletters',
    action: 'setStatus',
    data: {
      id: newsletter.id,
      status: 'active'
    }
  } : defaultParameters;
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_send_server_request_parameters', configureSendPageServerRequest);

var redirectAfterSendPageServerRequest = function redirectAfterSendPageServerRequest(defaultRedirect, newsletter) {
  return newsletter.type === 'automatic' ? '/' + newsletter.options.group : defaultRedirect;
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_send_server_request_response_redirect', redirectAfterSendPageServerRequest);

var configureSendPageServerResponse = function configureSendPageServerResponse(newsletter) {
  if (newsletter.type !== 'automatic') return null;

  var email = emails[newsletter.options.group];

  if (!email) return null;

  return function () {
    _mailpoet2.default.Notice.success(_mailpoet2.default.I18n.t('automaticEmailActivated').replace('%1s', email.title));
  };
};

_wpJsHooks2.default.addFilter('mailpoet_newsletters_send_server_request_response', configureSendPageServerResponse);

/***/ }),
/* 39 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.AutomaticEmailEventsList;

/***/ }),
/* 40 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _formFieldSelection = __webpack_require__(7);

var _formFieldSelection2 = _interopRequireDefault(_formFieldSelection);

var _automaticEmailsBreadcrumb = __webpack_require__(14);

var _automaticEmailsBreadcrumb2 = _interopRequireDefault(_automaticEmailsBreadcrumb);

var _events_list = __webpack_require__(15);

var _events_list2 = _interopRequireDefault(_events_list);

var _event_scheduling = __webpack_require__(16);

var _event_scheduling2 = _interopRequireDefault(_event_scheduling);

var _event_options = __webpack_require__(17);

var _event_options2 = _interopRequireDefault(_event_options);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var defaultAfterTimeType = 'immediate';
var defaultAfterTimeNumber = 1;

var EventsConditions = function (_React$Component) {
  _inherits(EventsConditions, _React$Component);

  _createClass(EventsConditions, null, [{
    key: 'getEventOptions',
    value: function getEventOptions(event) {
      return event.options || null;
    }
  }, {
    key: 'getEventOptionsFirstValue',
    value: function getEventOptionsFirstValue(eventOptions) {
      if (!eventOptions) return null;

      return _underscore2.default.isArray(eventOptions.values) && eventOptions.values[0].id ? eventOptions.values[0].id : null;
    }
  }, {
    key: 'displayBreadcrumbs',
    value: function displayBreadcrumbs() {
      return _react2.default.createElement(_automaticEmailsBreadcrumb2.default, { step: 'conditions' });
    }
  }]);

  function EventsConditions(props) {
    _classCallCheck(this, EventsConditions);

    var _this = _possibleConstructorReturn(this, (EventsConditions.__proto__ || Object.getPrototypeOf(EventsConditions)).call(this, props));

    _this.handleChange = _this.handleChange.bind(_this);
    _this.handleNextStep = _this.handleNextStep.bind(_this);
    _this.email = _this.props.route.data.email;
    _this.emailEvents = _this.email.events;
    _this.segments = _underscore2.default.filter(window.mailpoet_segments, function (segment) {
      return segment.deleted_at === null;
    });

    var currentEvent = _this.getEvent(_this.props.route.name);
    var currentEventOptions = _this.constructor.getEventOptions(currentEvent);
    var currentEventOptionValue = _this.constructor.getEventOptionsFirstValue(currentEventOptions);

    _this.state = {
      event: currentEvent,
      eventSlug: currentEvent.slug,
      eventOptionValue: currentEventOptionValue,
      segment: currentEvent.sendToLists ? _this.constructor.getFirstSegment() : null,
      afterTimeType: defaultAfterTimeType,
      afterTimeNumber: null
    };
    return _this;
  }

  _createClass(EventsConditions, [{
    key: 'getEvent',
    value: function getEvent(eventSlug) {
      return this.emailEvents[eventSlug];
    }
  }, {
    key: 'getFirstSegment',
    value: function getFirstSegment() {
      return _underscore2.default.isArray(this.segments) && this.segments[0].id ? this.segments[0].id : null;
    }
  }, {
    key: 'displayEventsList',
    value: function displayEventsList() {
      var props = {
        events: this.emailEvents,
        selectedEvent: this.state.eventSlug,
        onValueChange: this.handleChange
      };

      return _react2.default.createElement(_events_list2.default, props);
    }
  }, {
    key: 'displayEventOptions',
    value: function displayEventOptions() {
      var props = {
        emailSlug: this.email.slug,
        eventSlug: this.state.eventSlug,
        eventOptions: this.constructor.getEventOptions(this.state.event),
        onValueChange: this.handleChange

      };

      return _react2.default.createElement(_event_options2.default, props);
    }
  }, {
    key: 'displaySegments',
    value: function displaySegments() {
      var _this2 = this;

      if (!this.state.event.sendToLists) return null;

      var props = {
        field: {
          id: 'segments',
          forceSelect2: true,
          values: this.segments,
          extendSelect2Options: {
            minimumResultsForSearch: Infinity
          }
        },
        onValueChange: function onValueChange(e) {
          return _this2.handleChange({ segment: e.target.value });
        }
      };

      return _react2.default.createElement(
        'div',
        { className: 'event-segment-selection' },
        _react2.default.createElement(_formFieldSelection2.default, props)
      );
    }
  }, {
    key: 'displayScheduling',
    value: function displayScheduling() {
      var props = {
        item: {
          afterTimeNumber: this.state.afterTimeNumber,
          afterTimeType: this.state.afterTimeType
        },
        onValueChange: this.handleChange
      };

      return _react2.default.createElement(_event_scheduling2.default, props);
    }
  }, {
    key: 'displayEventTip',
    value: function displayEventTip() {
      return this.state.event.tip ? _react2.default.createElement(
        'p',
        { className: 'description' },
        _react2.default.createElement(
          'strong',
          null,
          _mailpoet2.default.I18n.t('tip')
        ),
        ' ',
        this.state.event.tip
      ) : null;
    }
  }, {
    key: 'handleChange',
    value: function handleChange(data) {
      var newState = data;

      if (newState.eventSlug) {
        newState.event = this.getEvent(newState.eventSlug);

        // keep the existing segment (if set) or set it to the first segment in the list
        newState.segment = newState.event.sendToLists ? this.state.segment || this.constructor.getFirstSegment() : null;

        // if the new event doesn't have options, reset the currently selected option value
        var eventOptions = this.constructor.getEventOptions(newState.event);
        newState.eventOptionValue = eventOptions ? this.constructor.getEventOptionsFirstValue(eventOptions) : null;
      }

      if (newState.afterTimeType && newState.afterTimeType === 'immediate') {
        newState.afterTimeNumber = null;
      } else if (newState.afterTimeType && !this.state.afterTimeNumber) {
        newState.afterTimeNumber = defaultAfterTimeNumber;
      }

      this.setState(newState);
    }
  }, {
    key: 'handleNextStep',
    value: function handleNextStep() {
      var _this3 = this;

      var options = {
        group: this.email.slug,
        event: this.state.eventSlug,
        afterTimeType: this.state.afterTimeType
      };
      if (this.state.afterTimeNumber) options.afterTimeNumber = this.state.afterTimeNumber;
      options.sendTo = this.state.event.sendToLists ? 'segment' : 'user';
      if (this.state.segment) options.segment = this.state.segment;
      if (this.state.eventOptionValue) {
        options.meta = JSON.stringify({ option: this.state.eventOptionValue });
      }

      _mailpoet2.default.Ajax.post({
        api_version: window.mailpoet_api_version,
        endpoint: 'newsletters',
        action: 'create',
        data: {
          type: 'automatic',
          subject: _mailpoet2.default.I18n.t('draftNewsletterTitle'),
          options: options
        }
      }).done(function (response) {
        _this3.props.router.push('/template/' + response.data.id);
      }).fail(function (response) {
        if (response.errors.length > 0) {
          _mailpoet2.default.Notice.error(response.errors.map(function (error) {
            return error.message;
          }), { scroll: true });
        }
      });
    }
  }, {
    key: 'render',
    value: function render() {
      var heading = _mailpoet2.default.I18n.t('selectAutomaticEmailsEventsConditionsHeading').replace('%1s', this.email.title);

      return _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(
          'h1',
          null,
          heading
        ),
        this.constructor.displayBreadcrumbs(),
        _react2.default.createElement(
          'div',
          { className: 'events-conditions-container' },
          _react2.default.createElement(
            'div',
            null,
            this.displayEventsList()
          ),
          _react2.default.createElement(
            'div',
            null,
            this.displayEventOptions()
          ),
          _react2.default.createElement(
            'div',
            null,
            this.displaySegments()
          ),
          _react2.default.createElement(
            'div',
            null,
            this.displayScheduling()
          )
        ),
        _react2.default.createElement(
          'p',
          { className: 'submit' },
          _react2.default.createElement('input', {
            className: 'button button-primary',
            type: 'button',
            onClick: this.handleNextStep,
            value: _mailpoet2.default.I18n.t('next')
          })
        ),
        this.displayEventTip()
      );
    }
  }]);

  return EventsConditions;
}(_react2.default.Component);

EventsConditions.propTypes = {
  router: _propTypes2.default.shape({
    push: _propTypes2.default.func.isRequired
  }).isRequired,
  route: _propTypes2.default.shape({
    data: _propTypes2.default.shape({
      email: _propTypes2.default.object.isRequired // eslint-disable-line react/forbid-prop-types
    }).isRequired,
    name: _propTypes2.default.string.isRequired
  }).isRequired,
  location: _propTypes2.default.object.isRequired // eslint-disable-line react/forbid-prop-types
};

module.exports = EventsConditions;

/***/ }),
/* 41 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.FormFieldText;

/***/ }),
/* 42 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.NewsletterSchedulingCommonOptions;

/***/ }),
/* 43 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _formFieldSelection = __webpack_require__(7);

var _formFieldSelection2 = _interopRequireDefault(_formFieldSelection);

var _events_list = __webpack_require__(15);

var _events_list2 = _interopRequireDefault(_events_list);

var _event_scheduling = __webpack_require__(16);

var _event_scheduling2 = _interopRequireDefault(_event_scheduling);

var _event_options = __webpack_require__(17);

var _event_options2 = _interopRequireDefault(_event_options);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var defaultAfterTimeType = 'immediate';
var defaultAfterTimeNumber = 1;

var SendEventConditions = function (_React$Component) {
  _inherits(SendEventConditions, _React$Component);

  function SendEventConditions(props) {
    _classCallCheck(this, SendEventConditions);

    var _this = _possibleConstructorReturn(this, (SendEventConditions.__proto__ || Object.getPrototypeOf(SendEventConditions)).call(this, props));

    _this.handleChange = _this.handleChange.bind(_this);
    _this.email = _this.props.field.email;
    _this.emailOptions = _this.props.field.emailOptions;
    _this.events = _underscore2.default.indexBy(_this.email.events, 'slug');
    _this.segments = _underscore2.default.filter(window.mailpoet_segments, function (segment) {
      return segment.deleted_at === null;
    });

    _this.state = {
      event: _this.events[_this.emailOptions.event],
      eventSlug: _this.emailOptions.event,
      eventOptionValue: null,
      afterTimeType: _this.emailOptions.afterTimeType || defaultAfterTimeType,
      afterTimeNumber: _this.emailOptions.afterTimeNumber || defaultAfterTimeNumber,
      segment: _this.emailOptions.segment ? _this.emailOptions.segment : null
    };
    return _this;
  }

  _createClass(SendEventConditions, [{
    key: 'displayEventsList',
    value: function displayEventsList() {
      var props = {
        disabled: true,
        events: this.events,
        selectedEvent: this.state.eventSlug
      };

      return _react2.default.createElement(_events_list2.default, props);
    }
  }, {
    key: 'displayEventOptions',
    value: function displayEventOptions() {
      var meta = this.emailOptions.meta || {};
      var props = {
        emailSlug: this.email.slug,
        eventSlug: this.state.eventSlug,
        onValueChange: this.handleChange,
        eventOptions: this.state.event.options || null
      };

      if (meta.option) {
        // if event uses remote filter to populate options, use the saved meta options
        // to build the initial select list
        if (props.eventOptions.type === 'remote') {
          props.eventOptions.values = meta.option;
        }
        // pre-select values
        props.selected = _underscore2.default.map(meta.option, function (data) {
          return data.id;
        });
      }

      return _react2.default.createElement(_event_options2.default, props);
    }
  }, {
    key: 'displaySegments',
    value: function displaySegments() {
      var _this2 = this;

      if (this.emailOptions.sendTo === 'user') return null;

      var props = {
        field: {
          id: 'segments',
          forceSelect2: true,
          values: this.segments,
          extendSelect2Options: {
            minimumResultsForSearch: Infinity
          },
          selected: function selected() {
            return _this2.state.segment;
          }
        },
        onValueChange: function onValueChange(e) {
          return _this2.handleChange({ segment: e.target.value });
        }
      };

      return _react2.default.createElement(
        'div',
        { className: 'event-segment-selection' },
        _react2.default.createElement(_formFieldSelection2.default, props)
      );
    }
  }, {
    key: 'displayScheduling',
    value: function displayScheduling() {
      var props = {
        item: {
          afterTimeNumber: this.state.afterTimeNumber,
          afterTimeType: this.state.afterTimeType
        },
        onValueChange: this.handleChange
      };

      return _react2.default.createElement(_event_scheduling2.default, props);
    }
  }, {
    key: 'handleChange',
    value: function handleChange(data) {
      var newState = data;

      if (newState.afterTimeType && newState.afterTimeType === 'immediate') {
        newState.afterTimeNumber = null;
      } else if (newState.afterTimeType && !this.state.afterTimeNumber) {
        newState.afterTimeNumber = defaultAfterTimeNumber;
      }

      this.setState(data, this.propagateChange);
    }
  }, {
    key: 'propagateChange',
    value: function propagateChange() {
      if (!this.props.onValueChange) return;

      var options = {
        group: this.email.slug,
        event: this.state.eventSlug,
        afterTimeType: this.state.afterTimeType
      };

      if (this.state.afterTimeNumber) options.afterTimeNumber = this.state.afterTimeNumber;
      if (this.state.segment) options.segment = this.state.segment;
      if (this.state.eventOptionValue) options.meta = { option: this.state.eventOptionValue };

      this.props.onValueChange({
        target: {
          name: 'options',
          value: options
        }
      });
    }
  }, {
    key: 'render',
    value: function render() {
      return _react2.default.createElement(
        'div',
        { className: 'events-conditions-container' },
        _react2.default.createElement(
          'div',
          null,
          this.displayEventsList()
        ),
        _react2.default.createElement(
          'div',
          null,
          this.displayEventOptions()
        ),
        _react2.default.createElement(
          'div',
          null,
          this.displaySegments()
        ),
        _react2.default.createElement(
          'div',
          null,
          this.displayScheduling()
        )
      );
    }
  }]);

  return SendEventConditions;
}(_react2.default.Component);

SendEventConditions.propTypes = {
  field: _propTypes2.default.shape({
    email: _propTypes2.default.shape({
      events: _propTypes2.default.object.isRequired // eslint-disable-line react/forbid-prop-types
    }).isRequired,
    emailOptions: _propTypes2.default.object.isRequired // eslint-disable-line react/forbid-prop-types
  }).isRequired,
  onValueChange: _propTypes2.default.func
};

SendEventConditions.defaultProps = {
  onValueChange: null
};

module.exports = SendEventConditions;

/***/ }),
/* 44 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _reactRouter = __webpack_require__(4);

var _listing = __webpack_require__(12);

var _listing2 = _interopRequireDefault(_listing);

var _newslettersListingsTabs = __webpack_require__(45);

var _newslettersListingsTabs2 = _interopRequireDefault(_newslettersListingsTabs);

var _newslettersListingsMixins = __webpack_require__(46);

var _classnames = __webpack_require__(47);

var _classnames2 = _interopRequireDefault(_classnames);

var _reactStringReplace = __webpack_require__(8);

var _reactStringReplace2 = _interopRequireDefault(_reactStringReplace);

var _reactTooltip = __webpack_require__(18);

var _reactTooltip2 = _interopRequireDefault(_reactTooltip);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _wpJsHooks = __webpack_require__(5);

var _wpJsHooks2 = _interopRequireDefault(_wpJsHooks);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mailpoetSegments = window.mailpoet_segments || {};
var mailpoetTrackingEnabled = !!window.mailpoet_tracking_enabled;
var automaticEmails = window.mailpoet_premium_automatic_emails || {};

var tooltipTextForWoocommerceGroup = (0, _reactStringReplace2.default)(_mailpoet2.default.I18n.t('feedbackButton'), /\[link\](.*?)\[\/link\]/g, function (match) {
  return _react2.default.createElement(
    'a',
    {
      href: 'https://mailpoet.polldaddy.com/s/woocommerce-automatic-feedback',
      key: 'feedback',
      target: '_blank',
      rel: 'noopener noreferrer'
    },
    match
  );
});

var messages = {
  onTrash: function onTrash(response) {
    var count = Number(response.meta.count);
    var message = null;

    if (count === 1) {
      message = _mailpoet2.default.I18n.t('oneNewsletterTrashed');
    } else {
      message = _mailpoet2.default.I18n.t('multipleNewslettersTrashed').replace('%$1d', count.toLocaleString());
    }
    _mailpoet2.default.Notice.success(message);
  },
  onDelete: function onDelete(response) {
    var count = Number(response.meta.count);
    var message = null;

    if (count === 1) {
      message = _mailpoet2.default.I18n.t('oneNewsletterDeleted');
    } else {
      message = _mailpoet2.default.I18n.t('multipleNewslettersDeleted').replace('%$1d', count.toLocaleString());
    }
    _mailpoet2.default.Notice.success(message);
  },
  onRestore: function onRestore(response) {
    var count = Number(response.meta.count);
    var message = null;

    if (count === 1) {
      message = _mailpoet2.default.I18n.t('oneNewsletterRestored');
    } else {
      message = _mailpoet2.default.I18n.t('multipleNewslettersRestored').replace('%$1d', count.toLocaleString());
    }
    _mailpoet2.default.Notice.success(message);
  }
};

var columns = [{
  name: 'subject',
  label: _mailpoet2.default.I18n.t('subject'),
  sortable: true
}, {
  name: 'status',
  label: _mailpoet2.default.I18n.t('status'),
  width: 145
}, {
  name: 'settings',
  label: _mailpoet2.default.I18n.t('settings')
}, {
  name: 'statistics',
  label: _mailpoet2.default.I18n.t('statistics'),
  display: mailpoetTrackingEnabled
}, {
  name: 'updated_at',
  label: _mailpoet2.default.I18n.t('lastModifiedOn'),
  sortable: true
}];

var bulkActions = [{
  name: 'trash',
  label: _mailpoet2.default.I18n.t('moveToTrash'),
  onSuccess: messages.onTrash
}];

var newsletterActions = [{
  name: 'view',
  link: function link(newsletter) {
    return _react2.default.createElement(
      'a',
      { href: newsletter.preview_url, target: '_blank' },
      _mailpoet2.default.I18n.t('preview')
    );
  }
}, {
  name: 'edit',
  link: function link(newsletter) {
    return _react2.default.createElement(
      'a',
      { href: '?page=mailpoet-newsletter-editor&id=' + newsletter.id },
      _mailpoet2.default.I18n.t('edit')
    );
  }
}, {
  name: 'duplicate',
  label: _mailpoet2.default.I18n.t('duplicate'),
  onClick: function onClick(newsletter, refresh) {
    return _mailpoet2.default.Ajax.post({
      api_version: window.mailpoet_api_version,
      endpoint: 'newsletters',
      action: 'duplicate',
      data: {
        id: newsletter.id
      }
    }).done(function (response) {
      _mailpoet2.default.Notice.success(_mailpoet2.default.I18n.t('newsletterDuplicated').replace('%$1s', response.data.subject));
      refresh();
    }).fail(function (response) {
      if (response.errors.length > 0) {
        _mailpoet2.default.Notice.error(response.errors.map(function (error) {
          return error.message;
        }), { scroll: true });
      }
    });
  }
}, {
  name: 'trash'
}];

_wpJsHooks2.default.addFilter('mailpoet_newsletters_listings_automatic_email_actions', _newslettersListingsMixins.StatisticsMixin.addStatsCTAAction);

var Listings = _react2.default.createClass({
  displayName: 'Listings',

  mixins: [_newslettersListingsMixins.StatisticsMixin, _newslettersListingsMixins.MailerMixin],
  contextTypes: {
    router: _react2.default.PropTypes.object.isRequired
  },
  updateStatus: function updateStatus(e) {
    var _this = this;

    // make the event persist so that we can still override the selected value
    // in the ajax callback
    e.persist();

    _mailpoet2.default.Ajax.post({
      api_version: window.mailpoet_api_version,
      endpoint: 'newsletters',
      action: 'setStatus',
      data: {
        id: Number(e.target.getAttribute('data-id')),
        status: e.target.value
      }
    }).done(function (response) {
      if (response.data.status === 'active') {
        _mailpoet2.default.Notice.success(_mailpoet2.default.I18n.t('automaticEmailActivated'));
      }
      // force refresh of listing so that groups are updated
      _this.forceUpdate();
    }).fail(function (response) {
      _mailpoet2.default.Notice.error(_mailpoet2.default.I18n.t('automaticEmailActivationFailed'));

      // reset value to actual newsletter's status
      e.target.value = response.status;
    });
  },
  renderStatus: function renderStatus(newsletter) {
    var totalSent = parseInt(newsletter.total_sent, 10) ? _mailpoet2.default.I18n.t('sentToXCustomers').replace('%$1d', newsletter.total_sent.toLocaleString()) : _mailpoet2.default.I18n.t('notSentYet');

    return _react2.default.createElement(
      'div',
      null,
      _react2.default.createElement(
        'p',
        null,
        _react2.default.createElement(
          'select',
          {
            'data-id': newsletter.id,
            defaultValue: newsletter.status,
            onChange: this.updateStatus
          },
          _react2.default.createElement(
            'option',
            { value: 'active' },
            _mailpoet2.default.I18n.t('active')
          ),
          _react2.default.createElement(
            'option',
            { value: 'draft' },
            _mailpoet2.default.I18n.t('inactive')
          )
        )
      ),
      _react2.default.createElement(
        'p',
        null,
        totalSent
      )
    );
  },
  renderSettings: function renderSettings(newsletter) {
    var event = automaticEmails[newsletter.options.group].events[newsletter.options.event];
    var meta = newsletter.options.meta || {};
    var metaOptionValues = meta.option ? _underscore2.default.pluck(meta.option, 'name') : [];
    var sendingEvent = void 0;
    var sendingDelay = void 0;
    var segment = void 0;

    if (meta.option && _underscore2.default.isEmpty(metaOptionValues)) {
      return _react2.default.createElement(
        'span',
        { className: 'mailpoet_error' },
        _mailpoet2.default.I18n.t('automaticEmailEventOptionsNotConfigured')
      );
    }

    // set sending event
    sendingEvent = event.listingScheduleDisplayText.replace('%s', metaOptionValues.join(', '));

    switch (newsletter.options.sendTo) {
      case 'user':
        sendingEvent = _mailpoet2.default.I18n.t('listingScheduleSendToCustomer').replace('%1s', sendingEvent);
        break;
      default:
        // get segment
        segment = _underscore2.default.find(mailpoetSegments, function (seg) {
          return Number(seg.id) === Number(newsletter.options.segment);
        });

        if (segment === undefined) {
          return _react2.default.createElement(
            'span',
            { className: 'mailpoet_error' },
            _mailpoet2.default.I18n.t('sendingToSegmentsNotSpecified')
          );
        }

        sendingEvent = _mailpoet2.default.I18n.t('listingScheduleSendToList').replace('%1s', sendingEvent).replace('%2s', segment.name);

        break;
    }

    // set sending delay
    if (sendingEvent) {
      if (newsletter.options.afterTimeType !== 'immediate') {
        switch (newsletter.options.afterTimeType) {
          case 'hours':
            sendingDelay = _mailpoet2.default.I18n.t('sendingDelayHours').replace('%$1d', newsletter.options.afterTimeNumber);
            break;

          case 'days':
            sendingDelay = _mailpoet2.default.I18n.t('sendingDelayDays').replace('%$1d', newsletter.options.afterTimeNumber);
            break;

          case 'weeks':
            sendingDelay = _mailpoet2.default.I18n.t('sendingDelayWeeks').replace('%$1d', newsletter.options.afterTimeNumber);
            break;

          default:
            sendingDelay = _mailpoet2.default.I18n.t('sendingDelayInvalid');
            break;
        }
        sendingEvent += ' [' + sendingDelay + ']';
      }
    }

    return _react2.default.createElement(
      'span',
      null,
      sendingEvent
    );
  },
  renderItem: function renderItem(newsletter, actions) {
    var rowClasses = (0, _classnames2.default)('manage-column', 'column-primary', 'has-row-actions');

    return _react2.default.createElement(
      'div',
      null,
      _react2.default.createElement(
        'td',
        { className: rowClasses },
        _react2.default.createElement(
          'strong',
          null,
          _react2.default.createElement(
            'a',
            {
              className: 'row-title',
              href: '?page=mailpoet-newsletter-editor&id=' + newsletter.id
            },
            newsletter.subject
          )
        ),
        actions
      ),
      _react2.default.createElement(
        'td',
        { className: 'column', 'data-colname': _mailpoet2.default.I18n.t('status') },
        this.renderStatus(newsletter)
      ),
      _react2.default.createElement(
        'td',
        { className: 'column', 'data-colname': _mailpoet2.default.I18n.t('settings') },
        this.renderSettings(newsletter)
      ),
      mailpoetTrackingEnabled === true ? _react2.default.createElement(
        'td',
        { className: 'column', 'data-colname': _mailpoet2.default.I18n.t('statistics') },
        this.renderStatistics(newsletter, newsletter.total_sent > 0 && newsletter.statistics)
      ) : null,
      _react2.default.createElement(
        'td',
        { className: 'column-date', 'data-colname': _mailpoet2.default.I18n.t('lastModifiedOn') },
        _react2.default.createElement(
          'abbr',
          null,
          _mailpoet2.default.Date.format(newsletter.updated_at)
        )
      )
    );
  },
  render: function render() {
    var automaticEmailGroup = this.props.route.params.tab;
    var params = this.props.params;

    params.group = automaticEmailGroup;

    var feedbackButton = params.group !== 'woocommerce' ? '' : _react2.default.createElement(
      'div',
      { className: 'automatic-listing-woocommerce-feedback-container' },
      _react2.default.createElement(
        'span',
        {
          className: 'feedback-tooltip',
          'data-event': 'click',
          'data-tip': true,
          'data-for': 'automatic-listing-woocommerce-feedback-tooltip'
        },
        _mailpoet2.default.I18n.t('feedback')
      ),
      _react2.default.createElement(
        _reactTooltip2.default,
        {
          globalEventOff: 'click',
          multiline: true,
          id: 'automatic-listing-woocommerce-feedback-tooltip',
          efect: 'solid',
          place: 'right'
        },
        _react2.default.createElement(
          'span',
          {
            style: {
              pointerEvents: 'all',
              display: 'inline-block'
            }
          },
          tooltipTextForWoocommerceGroup
        )
      )
    );

    return _react2.default.createElement(
      'div',
      null,
      _react2.default.createElement(
        'h1',
        { className: 'title' },
        _mailpoet2.default.I18n.t('pageTitle'),
        ' ',
        _react2.default.createElement(
          _reactRouter.Link,
          { className: 'page-title-action', to: '/new', 'data-automation-id': 'new_email' },
          _mailpoet2.default.I18n.t('new')
        )
      ),
      _react2.default.createElement(_newslettersListingsTabs2.default, { tab: automaticEmailGroup }),
      _react2.default.createElement(_listing2.default, {
        limit: window.mailpoet_listing_per_page,
        location: this.props.location,
        params: params,
        endpoint: 'newsletters',
        type: 'automatic',
        base_url: automaticEmailGroup,
        onRenderItem: this.renderItem,
        columns: columns,
        bulk_actions: bulkActions,
        item_actions: newsletterActions,
        messages: messages,
        auto_refresh: true,
        sort_by: 'updated_at',
        sort_order: 'desc',
        afterGetItems: this.checkMailerStatus
      }),
      feedbackButton
    );
  }
});

module.exports = Listings;

/***/ }),
/* 45 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.NewslettersListingsTabs;

/***/ }),
/* 46 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.NewslettersListingsMixins;

/***/ }),
/* 47 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.ClassNames;

/***/ }),
/* 48 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _reactDom = __webpack_require__(49);

var _reactDom2 = _interopRequireDefault(_reactDom);

var _reactRouter = __webpack_require__(4);

var _list = __webpack_require__(50);

var _list2 = _interopRequireDefault(_list);

var _form = __webpack_require__(51);

var _form2 = _interopRequireDefault(_form);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// import doesn't work here :( babel with webpack use history['default'] which is undefined
var _require = __webpack_require__(56),
    createHashHistory = _require.createHashHistory;

var history = (0, _reactRouter.useRouterHistory)(createHashHistory)({ queryKey: false });

var App = _react2.default.createClass({
  displayName: 'App',
  render: function render() {
    return this.props.children;
  }
});

var container = document.getElementById('dynamic_segments_container');

if (container) {
  _reactDom2.default.render(_react2.default.createElement(
    _reactRouter.Router,
    { history: history },
    _react2.default.createElement(
      _reactRouter.Route,
      { path: '/', component: App },
      _react2.default.createElement(_reactRouter.IndexRoute, { component: _list2.default }),
      _react2.default.createElement(_reactRouter.Route, { path: 'new', component: _form2.default }),
      _react2.default.createElement(_reactRouter.Route, { path: 'edit/:id', component: _form2.default }),
      _react2.default.createElement(_reactRouter.Route, { path: '*', component: _list2.default })
    )
  ), container);
}

/***/ }),
/* 49 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.ReactDOM;

/***/ }),
/* 50 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _reactRouter = __webpack_require__(4);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _listing = __webpack_require__(12);

var _listing2 = _interopRequireDefault(_listing);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var columns = [{
  name: 'name',
  label: _mailpoet2.default.I18n.t('nameColumn'),
  sortable: true
}, {
  name: 'count',
  label: _mailpoet2.default.I18n.t('subscribersCountColumn'),
  sortable: false
}, {
  name: 'updated_at',
  label: _mailpoet2.default.I18n.t('updatedAtColumn'),
  sortable: true
}];

var messages = {
  onLoadingItems: function onLoadingItems() {
    return _mailpoet2.default.I18n.t('loadingDynamicSegmentItems');
  },
  onNoItemsFound: function onNoItemsFound() {
    return _mailpoet2.default.I18n.t('noDynamicSegmentItemsFound');
  },
  onTrash: function onTrash(response) {
    var count = Number(response.meta.count);
    var message = null;

    if (count === 1) {
      message = _mailpoet2.default.I18n.t('oneSegmentTrashed');
    } else {
      message = _mailpoet2.default.I18n.t('multipleSegmentsTrashed').replace('%$1d', count.toLocaleString());
    }
    _mailpoet2.default.Notice.success(message);
  },
  onDelete: function onDelete(response) {
    var count = Number(response.meta.count);
    var message = null;

    if (count === 1) {
      message = _mailpoet2.default.I18n.t('oneSegmentDeleted');
    } else {
      message = _mailpoet2.default.I18n.t('multipleSegmentsDeleted').replace('%$1d', count.toLocaleString());
    }
    _mailpoet2.default.Notice.success(message);
  },
  onRestore: function onRestore(response) {
    var count = Number(response.meta.count);
    var message = null;

    if (count === 1) {
      message = _mailpoet2.default.I18n.t('oneSegmentRestored');
    } else {
      message = _mailpoet2.default.I18n.t('multipleSegmentsRestored').replace('%$1d', count.toLocaleString());
    }
    _mailpoet2.default.Notice.success(message);
  }
};

var itemActions = [{
  name: 'edit',
  link: function link(item) {
    return _react2.default.createElement(
      _reactRouter.Link,
      { to: '/edit/' + item.id },
      _mailpoet2.default.I18n.t('edit')
    );
  }
}, {
  name: 'view_subscribers',
  link: function link(item) {
    return _react2.default.createElement(
      'a',
      { href: item.subscribers_url },
      _mailpoet2.default.I18n.t('viewSubscribers')
    );
  }
}, {
  name: 'trash'
}];

function renderItem(item, actions) {
  return _react2.default.createElement(
    'div',
    null,
    _react2.default.createElement(
      'td',
      { 'data-colname': _mailpoet2.default.I18n.t('nameColumn') },
      _react2.default.createElement(
        'strong',
        null,
        item.name
      ),
      actions
    ),
    _react2.default.createElement(
      'td',
      { className: 'column', 'data-colname': _mailpoet2.default.I18n.t('subscribersCountColumn') },
      item.count
    ),
    _react2.default.createElement(
      'td',
      { className: 'column', 'data-colname': _mailpoet2.default.I18n.t('updatedAtColumn') },
      _mailpoet2.default.Date.format(item.updated_at)
    )
  );
}

function DynamicSegmentList(props) {
  return _react2.default.createElement(
    'div',
    null,
    _react2.default.createElement(
      'h1',
      { className: 'title' },
      _mailpoet2.default.I18n.t('pageTitle'),
      ' ',
      _react2.default.createElement(
        _reactRouter.Link,
        { className: 'page-title-action', to: '/new' },
        _mailpoet2.default.I18n.t('new')
      )
    ),
    _react2.default.createElement(_listing2.default, {
      limit: window.mailpoet_listing_per_page,
      location: props.location,
      params: props.params,
      search: true,
      onRenderItem: renderItem,
      endpoint: 'dynamic_segments',
      columns: columns,
      messages: messages,
      sort_by: 'created_at',
      sort_order: 'desc',
      item_actions: itemActions
    }),
    _react2.default.createElement(
      'div',
      null,
      _react2.default.createElement(
        'p',
        { className: 'mailpoet_sending_methods_help help' },
        _react2.default.createElement(
          'b',
          null,
          _mailpoet2.default.I18n.t('segmentsTip'),
          ':'
        ),
        ' ',
        _mailpoet2.default.I18n.t('segmentsTipText'),
        ' ',
        _react2.default.createElement(
          'a',
          {
            href: 'http://beta.docs.mailpoet.com/article/237-guide-to-subscriber-segmentation?utm_source=plugin&utm_medium=segments&utm_campaign=helpdocs',
            target: '_blank',
            rel: 'noopener noreferrer'
          },
          _mailpoet2.default.I18n.t('segmentsTipLink')
        )
      )
    )
  );
}

DynamicSegmentList.propTypes = {
  location: _propTypes2.default.object.isRequired, // eslint-disable-line react/forbid-prop-types
  params: _propTypes2.default.object.isRequired // eslint-disable-line react/forbid-prop-types
};

module.exports = DynamicSegmentList;

/***/ }),
/* 51 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _reactRouter = __webpack_require__(4);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _form = __webpack_require__(52);

var _form2 = _interopRequireDefault(_form);

var _propTypes = __webpack_require__(3);

var _propTypes2 = _interopRequireDefault(_propTypes);

var _reactTooltip = __webpack_require__(18);

var _reactTooltip2 = _interopRequireDefault(_reactTooltip);

var _reactStringReplace = __webpack_require__(8);

var _reactStringReplace2 = _interopRequireDefault(_reactStringReplace);

var _wordpress_role = __webpack_require__(53);

var _wordpress_role2 = _interopRequireDefault(_wordpress_role);

var _email = __webpack_require__(54);

var _email2 = _interopRequireDefault(_email);

var _woocommerce = __webpack_require__(55);

var _woocommerce2 = _interopRequireDefault(_woocommerce);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var tooltipText = (0, _reactStringReplace2.default)(_mailpoet2.default.I18n.t('tooltipSegments'), /\[link\](.*?)\[\/link\]/g, function (match) {
  return _react2.default.createElement(
    'a',
    {
      href: 'https://mailpoet.polldaddy.com/s/segmentation-feedback',
      key: 'feedback',
      target: '_blank',
      rel: 'noopener noreferrer'
    },
    match
  );
});

var messages = {
  onUpdate: function onUpdate() {
    return _mailpoet2.default.Notice.success(_mailpoet2.default.I18n.t('segmentUpdated'));
  },
  onCreate: function onCreate(data) {
    _mailpoet2.default.Notice.success(_mailpoet2.default.I18n.t('segmentAdded'));
    _mailpoet2.default.trackEvent('Segments > Add new', {
      'MailPoet Free version': window.mailpoet_version,
      type: data.segmentType || 'unknown type',
      subtype: data.action || data.wordpressRole || 'unknown subtype'
    });
  }
};

function getAvailableFilters() {
  var filters = {
    email: _mailpoet2.default.I18n.t('email'),
    userRole: _mailpoet2.default.I18n.t('wpUserRole')
  };
  if (window.is_woocommerce_active) {
    filters.woocommerce = _mailpoet2.default.I18n.t('woocommerce');
  }
  return filters;
}

var DynamicSegmentForm = function (_React$Component) {
  _inherits(DynamicSegmentForm, _React$Component);

  function DynamicSegmentForm(props) {
    _classCallCheck(this, DynamicSegmentForm);

    var _this = _possibleConstructorReturn(this, (DynamicSegmentForm.__proto__ || Object.getPrototypeOf(DynamicSegmentForm)).call(this, props));

    _this.state = {
      item: {
        segmentType: 'email'
      },
      childFields: [],
      errors: undefined
    };
    _this.loadFields();
    _this.handleValueChange = _this.handleValueChange.bind(_this);
    _this.handleSave = _this.handleSave.bind(_this);
    _this.onItemLoad = _this.onItemLoad.bind(_this);
    return _this;
  }

  _createClass(DynamicSegmentForm, [{
    key: 'onItemLoad',
    value: function onItemLoad(loadedData) {
      var item = _underscore2.default.mapObject(loadedData, function (val) {
        return _underscore2.default.isNull(val) ? '' : val;
      });
      this.setState({ item: item }, this.loadFields);
    }
  }, {
    key: 'getFields',
    value: function getFields() {
      return [{
        name: 'name',
        label: _mailpoet2.default.I18n.t('name'),
        type: 'text'
      }, {
        name: 'description',
        label: _mailpoet2.default.I18n.t('description'),
        type: 'textarea',
        tip: _mailpoet2.default.I18n.t('descriptionTip')
      }, {
        name: 'filters',
        description: 'main',
        label: _mailpoet2.default.I18n.t('formSegmentTitle'),
        fields: [{
          name: 'segmentType',
          type: 'select',
          values: getAvailableFilters()
        }].concat(_toConsumableArray(this.state.childFields))
      }];
    }
  }, {
    key: 'getChildFields',
    value: function getChildFields() {
      switch (this.state.item.segmentType) {
        case 'userRole':
          return (0, _wordpress_role2.default)();

        case 'email':
          return (0, _email2.default)(this.state.item);

        case 'woocommerce':
          return (0, _woocommerce2.default)(this.state.item);

        default:
          return [];
      }
    }
  }, {
    key: 'loadFields',
    value: function loadFields() {
      var _this2 = this;

      this.getChildFields().then(function (fields) {
        return _this2.setState({
          childFields: fields
        });
      });
    }
  }, {
    key: 'handleValueChange',
    value: function handleValueChange(e) {
      var item = this.state.item;

      var field = e.target.name;

      item[field] = e.target.value;

      this.setState({
        item: item
      });
      this.loadFields();
      return true;
    }
  }, {
    key: 'handleSave',
    value: function handleSave(e) {
      var _this3 = this;

      e.preventDefault();
      this.setState({ errors: undefined });
      _mailpoet2.default.Ajax.post({
        api_version: window.mailpoet_api_version,
        endpoint: 'dynamic_segments',
        action: 'save',
        data: this.state.item
      }).done(function () {
        _this3.context.router.push('/');

        if (_this3.props.params.id !== undefined) {
          messages.onUpdate();
        } else {
          messages.onCreate(_this3.state.item);
        }
      }).fail(function (response) {
        if (response.errors.length > 0) {
          _this3.setState({ errors: response.errors });
        }
      });
    }
  }, {
    key: 'render',
    value: function render() {
      var fields = this.getFields();
      return _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(
          'h1',
          { className: 'title' },
          _mailpoet2.default.I18n.t('formPageTitle'),
          ' ',
          _react2.default.createElement(
            _reactRouter.Link,
            { className: 'page-title-action', to: '/' },
            _mailpoet2.default.I18n.t('backToList')
          )
        ),
        _react2.default.createElement(_form2.default, {
          endpoint: 'dynamic_segments',
          fields: fields,
          params: this.props.params,
          messages: messages,
          onChange: this.handleValueChange,
          onSubmit: this.handleSave,
          onItemLoad: this.onItemLoad,
          item: this.state.item,
          errors: this.state.errors
        }),
        _react2.default.createElement(
          'span',
          {
            className: 'feedback-tooltip',
            'data-event': 'click',
            'data-tip': true,
            'data-for': 'feedback-segments-new'
          },
          _mailpoet2.default.I18n.t('feedback')
        ),
        _react2.default.createElement(
          _reactTooltip2.default,
          {
            globalEventOff: 'click',
            multiline: true,
            id: 'feedback-segments-new',
            efect: 'solid',
            place: 'right'
          },
          _react2.default.createElement(
            'span',
            {
              style: {
                pointerEvents: 'all',
                display: 'inline-block'
              }
            },
            tooltipText
          )
        )
      );
    }
  }]);

  return DynamicSegmentForm;
}(_react2.default.Component);

DynamicSegmentForm.contextTypes = {
  router: _react2.default.PropTypes.object.isRequired
};

DynamicSegmentForm.propTypes = {
  params: _propTypes2.default.shape({
    id: _propTypes2.default.string
  }).isRequired
};

module.exports = DynamicSegmentForm;

/***/ }),
/* 52 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.Form;

/***/ }),
/* 53 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

module.exports = function () {
  return Promise.resolve([{
    name: 'wordpressRole',
    type: 'select',
    placeholder: _mailpoet2.default.I18n.t('selectUserRolePlaceholder'),
    values: window.wordpress_editable_roles_list.reduce(function (currentValue, accumulator) {
      return _underscore2.default.extend({}, currentValue, _defineProperty({}, accumulator.role_id, accumulator.role_name));
    }, {})
  }]);
};

/***/ }),
/* 54 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var loadedLinks = {};

function loadLinks(formItems) {
  if (formItems.action !== 'clicked' && formItems.action !== 'notClicked') return Promise.resolve();
  if (!formItems.newsletter_id) return Promise.resolve();
  if (loadedLinks[formItems.newsletter_id] !== undefined) {
    return Promise.resolve(loadedLinks[formItems.newsletter_id]);
  }

  return _mailpoet2.default.Ajax.post({
    api_version: window.mailpoet_api_version,
    endpoint: 'newsletter_links',
    action: 'get',
    data: {
      newsletterId: formItems.newsletter_id
    }
  }).then(function (response) {
    var data = response.data;

    loadedLinks[formItems.newsletter_id] = data;
    return data;
  }).fail(function (response) {
    _mailpoet2.default.Notice.error(response.errors.map(function (error) {
      return error.message;
    }), { scroll: true });
  });
}

module.exports = function (formItems) {
  return loadLinks(formItems).then(function (links) {
    var basicFields = [{
      name: 'action',
      type: 'select',
      values: {
        '': _mailpoet2.default.I18n.t('selectActionPlaceholder'),
        opened: _mailpoet2.default.I18n.t('emailActionOpened'),
        notOpened: _mailpoet2.default.I18n.t('emailActionNotOpened'),
        clicked: _mailpoet2.default.I18n.t('emailActionClicked'),
        notClicked: _mailpoet2.default.I18n.t('emailActionNotClicked')
      }
    }, {
      name: 'newsletter_id',
      type: 'selection',
      resetSelect2OnUpdate: true,
      endpoint: 'newsletters_list',
      placeholder: _mailpoet2.default.I18n.t('selectNewsletterPlaceholder'),
      forceSelect2: true,
      getLabel: function getLabel(newsletter) {
        var sentAt = newsletter.sent_at ? _mailpoet2.default.Date.format(newsletter.sent_at) : _mailpoet2.default.I18n.t('notSentYet');
        return newsletter.subject + ' (' + sentAt + ')';
      }
    }];
    if (links) {
      return [].concat(basicFields, [{
        name: 'link_id',
        type: 'selection',
        placeholder: _mailpoet2.default.I18n.t('selectLinkPlaceholder'),
        forceSelect2: true,
        getLabel: function getLabel(link) {
          return link.url;
        },
        values: links
      }]);
    }
    return basicFields;
  });
};

/***/ }),
/* 55 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _mailpoet = __webpack_require__(1);

var _mailpoet2 = _interopRequireDefault(_mailpoet);

var _underscore = __webpack_require__(2);

var _underscore2 = _interopRequireDefault(_underscore);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var actionsField = {
  name: 'action',
  type: 'select',
  values: {
    '': _mailpoet2.default.I18n.t('selectActionPlaceholder'),
    purchasedCategory: _mailpoet2.default.I18n.t('wooPurchasedCategory'),
    purchasedProduct: _mailpoet2.default.I18n.t('wooPurchasedProduct')
  }
};

var categoriesField = {
  name: 'category_id',
  type: 'selection',
  endpoint: 'product_categories',
  resetSelect2OnUpdate: true,
  placeholder: _mailpoet2.default.I18n.t('selectWooPurchasedCategory'),
  forceSelect2: true,
  getLabel: _underscore2.default.property('cat_name'),
  getValue: _underscore2.default.property('term_id')
};

var productsField = {
  name: 'product_id',
  type: 'selection',
  endpoint: 'products',
  resetSelect2OnUpdate: true,
  placeholder: _mailpoet2.default.I18n.t('selectWooPurchasedProduct'),
  forceSelect2: true,
  getLabel: _underscore2.default.property('title'),
  getValue: _underscore2.default.property('ID')
};

module.exports = function (formItems) {
  var formFields = [actionsField];
  if (formItems.action === 'purchasedCategory') {
    formFields.push(categoriesField);
  }
  if (formItems.action === 'purchasedProduct') {
    formFields.push(productsField);
  }
  return Promise.resolve(formFields);
};

/***/ }),
/* 56 */
/***/ (function(module, exports) {

module.exports = MailPoetLib.History;

/***/ })
/******/ ]);