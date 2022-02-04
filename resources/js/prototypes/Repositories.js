class Repositories {
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
    return new Repositories(async_result);
  }

  static async post(apiUrl, objParam) {
    const async_result = await axios
      .post(apiUrl, objParam)
      .catch(function(error) {
        return error.response;
      });
    return new Repositories(async_result);
  }

  static async postFromData(apiUrl, objParam) {
    const async_result = await axios
      .post(apiUrl, objParam, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
      .catch(function(error) {
        return error.response;
      });
    return new Repositories(async_result);
  }

  static async put(apiUrl, objParam) {
    const async_result = await axios
      .put(apiUrl, objParam)
      .catch(function(error) {
        return error.response;
      });
    return new Repositories(async_result);
  }

  static async delete(apiUrl, objParam) {
    const async_result = await axios
      .delete(apiUrl, objParam)
      .catch(function(error) {
        return error.response;
      });
    return new Repositories(async_result);
  }

  static async patch(apiUrl, objParam) {
    const async_result = await axios
      .patch(apiUrl, objParam)
      .catch(function(error) {
        return error.response;
      });
    return new Repositories(async_result);
  }
}

export default Repositories;
