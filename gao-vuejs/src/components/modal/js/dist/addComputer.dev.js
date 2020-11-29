"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _vuex = require("vuex");

var _api = _interopRequireDefault(require("../../../service/api"));

var _computer = _interopRequireDefault(require("../../../service/computer"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var _default = {
  name: 'addComputer',
  data: function data() {
    return {
      dialog: false,
      name: "",
      disableCreer: true,
      rules: {
        required: function required(value) {
          return !!value || 'Required.';
        },
        min: function min(v) {
          return v.length >= 3 || 'Min 3 characters';
        }
      }
    };
  },
  methods: _objectSpread({
    verifyData: function verifyData() {
      if (this.name.length > 2 && typeof this.name == "string") {
        this.disableCreer = false;
      } else {
        this.disableCreer = true;
      }
    },
    addComputer: function addComputer() {
      var data, res;
      return regeneratorRuntime.async(function addComputer$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              data = {
                name: this.name
              };
              _context.next = 3;
              return regeneratorRuntime.awrap(_computer["default"].create(data));

            case 3:
              res = _context.sent;
              console.log(res); //this.addNewComputer(data)
              //this.name = ""
              //this.dialog = false

            case 5:
            case "end":
              return _context.stop();
          }
        }
      }, null, this);
    }
  }, (0, _vuex.mapActions)(['addNewComputer']))
};
exports["default"] = _default;