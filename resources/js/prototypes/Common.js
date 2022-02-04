import formToObject from "form_to_object";

class Common {
  constructor() {}

  /**
   * 오브젝트를 파라메터 데이터로 전환
   *
   * @static
   * @param {*} obj
   * @returns
   * @memberof Common
   */
  static objToParam(obj) {
    let str = "";
    for (let key in obj) {
      if (str != "") {
        str += "&";
      }
      str += key + "=" + encodeURIComponent(obj[key]);
    }
    return str;
  }

  /**
   * 폼을 오브젝트로 변환
   *
   * @static
   * @param {*} form
   * @returns
   * @memberof Common
   */
  static serializeObject(form) {
    return formToObject(form);
  }

  /**
   * string을 object로 변환하여, 연결된 값 찾기
   * @param  {} o
   * @param  {} s
   */
  static objectByString(o, s) {
    s = s.replace(/\[(\w+)\]/g, ".$1"); // convert indexes to properties
    s = s.replace(/^\./, ""); // strip a leading dot
    var a = s.split(".");
    for (var i = 0, n = a.length; i < n; ++i) {
      var k = a[i];
      if (k in o) {
        o = o[k];
      } else {
        return;
      }
    }
    return o;
  }

  /**
   * Object undefined 체크
   * @param  {} s
   */
  static objDeepTest(s) {
    s = s.split(".");
    var obj = window[s.shift()];
    while (obj && s.length) obj = obj[s.shift()];
    return obj;
  }
}

export default Common;
