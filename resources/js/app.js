// WEBAPP 환경설정
WEBAPP_CONFIG.currentLocale = WEBAPP_CONFIG.currentLocale ?? "ko";
WEBAPP_CONFIG.appDebug = WEBAPP_CONFIG.appDebug ?? false;
WEBAPP_CONFIG.openApiPrefix = WEBAPP_CONFIG.openApiPrefix ?? false;

// bootstrap
window._ = require("lodash");
window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/* moment : 전역으로 설치 */
window.moment = require("moment");

require("mpcs/js/plugins/icon_localstorage");
import { Dropdown, Collapse, Popover, Offcanvas } from "bootstrap";

// plugins 시작
import { Article } from "./plugins/index";

(function() {
  const ARTICLE = (element, options) => {
    new Article(element, options);
  };
  window.WEBAPP = {
    ARTICLE: ARTICLE,
  };
})(window);

document.addEventListener("DOMContentLoaded", () => {});
