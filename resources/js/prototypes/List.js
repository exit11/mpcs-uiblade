class List {
  constructor(async_param) {
    if (typeof async_param === "undefined") {
      throw new Error(`${MPCSUI.i18n.word.crud.data_request_failed}`);
    }
    if (async_param.status > 210) {
      switch (async_param.status) {
        case 401:
          if (MPCSUI.appDebug) {
            console.log(async_param.data);
          }
          break;

        case 422:
          let message = async_param.data.result.message;
          if (async_param.data.result.exception.errors) {
            let errors = Object.values(
              async_param.data.result.exception.errors
            );
            errors = errors.join("<br>");
            message = `${message}<br>${errors}`;
          }
          break;

        default:
          break;
      }
    }
    return async_param;
  }

  static async get(apiUrl, objParam) {
    const async_result = await axios
      .get(apiUrl, objParam)
      .catch(function(error) {
        return error.response;
      });
    return new List(async_result);
  }
}

export default List;
