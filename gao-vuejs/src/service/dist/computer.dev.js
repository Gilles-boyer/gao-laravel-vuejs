"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _api = _interopRequireDefault(require("./api"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

//collection of request to API for computer
var _default = {
  create: function create(data) {
    return _api["default"].post('computers', data);
  }
};
exports["default"] = _default;