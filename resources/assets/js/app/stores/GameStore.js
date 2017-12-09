import Cookies from 'js-cookie';
import Api from '../utilities/Api';

class GameStore {
  roleSlug = Cookies.get('roleSlug');
  _api = Api.collection();
  _data = {
    characters: {},
  };
  _listeners = [];
  _showEveryone = false;

  constructor() {
    if (this.roleSlug) {
      this.loadRole(this.roleSlug);
    }
  }

  clearRole() {
    Cookies.remove('roleSlug');
  }

  loadRole(roleSlug) {
    if (this._isNotLoadingOrLoaded('role')) {
      Cookies.set('roleSlug', roleSlug, {
        expires: 30,
      });
      this.roleSlug = roleSlug;

      this.loadCharacter(roleSlug);
    }
  }

  _isNotLoadingOrLoaded(name, data = this._data, callback) {
    if (this._api.requests[name]) {
      return false;
    } else if (!data[name]) {
      return true;
    } else {
      if (callback) {
        callback(data[name]);
      }

      this._broadcast();

      return false;
    }
  }

  getRole() {
    return this._data.role;
  }

  loadCharacters() {
    if (this._isNotLoadingOrLoaded('characters', this._data.characters)) {
      this._api
        .request('characters')
        .get('/api/characters')
        .then(this._thenBroadcast((characters) => {
          this._data.characters = characters;
          this._showEveryone = true;
        }))
        .catch(this._broadcast);
    }
  }

  getCharacters() {
    return this._data.characters;
  }

  showEveryone() {
    return this._showEveryone;
  }

  loadCharacter(characterSlug) {
    if (this._isNotLoadingOrLoaded(characterSlug, this._data.characters)) {
      this._api
        .request(characterSlug)
        .get(`/api/characters/${characterSlug}`)
        .then(this._thenBroadcast((character) => {
          this._data.characters[characterSlug] = character;

          if (characterSlug === this.roleSlug) {
            this._data.role = character;
          }
        }))
        .catch(this._broadcast);
    }
  }

  getCharacter(characterSlug) {
    return this._data.characters[characterSlug];
  }

  loadActs() {
    this.loadStory((story) => {
      const storyBegins = story.begins.replace(/-/g, '/');

      this._loadGenericData('acts', `/api/characters/${this.roleSlug}/instructions`, (acts) =>
        this._data.acts || acts.map((act) => ({
          ...act,
          begins: new Date(`${storyBegins} ${act.begins}`).getTime(),
        }))
      );

      return story;
    });
  }

  _loadGenericData(name, url, callback) {
    if (this._isNotLoadingOrLoaded(name, this.data, callback)) {
      this._api
        .request(name)
        .get(url)
        .then(callback)
        .then(this._thenBroadcast((data) => this._data[name] = data))
        .catch(this._broadcast);
    }
  }

  getActs() {
    return this._data.acts;
  }

  loadStory(callback) {
    this._loadGenericData('story', '/api/story', callback);
  }

  getStory() {
    return this._data.story;
  }

  _thenBroadcast(method) {
    return (...args) => {
      method(...args);

      this._broadcast();
    };
  }

  _broadcast() {
    this._listeners.forEach((listener) => listener());
  }

  subscribe(listener) {
    this._listeners.push(listener);
  }

  unsubscribe(listener) {
    const index = this._listeners.indexOf(listener);

    if (index > -1) {
      this._listeners.splice(index, 1);
    }
  }
}

export default window.GameStore = new GameStore;
