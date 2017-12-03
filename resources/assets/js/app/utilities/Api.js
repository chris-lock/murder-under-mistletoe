import 'whatwg-fetch';

class ApiCollection {
  requests = {};

  request(name) {
    return this.requests[name] = new Api((response) => {
      delete this.requests[name];

      return response;
    })
  }
}

class Api {
  constructor(onResponse = (response) => response) {
    this._onResponse = onResponse;
  }

  collection() {
    return new ApiCollection;
  }

  get(url, params = {}) {
    return this._fetch(url, params, 'GET');
  }

  post(url, body = {}) {
    return this._fetch(url, {}, 'POST', body);
  }

  put(url, body = {}) {
    return this._fetch(url, {}, 'PUT', body);
  }

  delete(url, param = {}) {
    return this._fetch(url, params, 'DELETE');
  }

  _fetch(url, params, method, body) {
    return fetch(this._urlWithQuery(url, params), this._request(method, body))
      .then(this._onResponse)
      .then(this._handleStatus)
      .then(this._parseResponse);
  }

  _urlWithQuery(url, params) {
    var serializedQuery = this._serializeQuery(params);

    return (serializedQuery)
      ? `${url}?${serializedQuery}`
      : url;
  }

  _serializeQuery(params, prefix) {
    return Object.keys(params).map((key) => {
      let value  = params[key];

      if (prefix) {
        if (Array.isArray(params)) {
          key = `${prefix}[]`;
        } else if (this.isObject(params)) {
          key = `${prefix}[${key}]`;
        }
      }

      return (this.isObject(value) || Array.isArray(value))
        ? this._serializeQuery(value, key)
        : `${key}=${encodeURIComponent(value)}`;
    })
    .join('&');
  }

  _request(method, body) {
    const request = {
      method,
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': this._csrf(),
      },
    };

    if (body) {
      request.body = JSON.stringify(body);
    }

    return request;
  }

  _csrf() {
    const csrfToken = document.getElementsByName("csrf-token")[0];

    return (csrfToken)
      ? csrfToken.getAttribute('content')
      : '';
  }

  _handleStatus(response) {
    if (!response.ok) {
      let error = new Error(response.statusText);
      error.response = 'response';

      throw error;
    }

    return response;
  }

  _parseResponse(response) {
    const contentType = response.headers.get('content-type');

    return (contentType && contentType.includes('application/json'))
      ? response.json()
      : response.body;
  }
}

export default new Api;
