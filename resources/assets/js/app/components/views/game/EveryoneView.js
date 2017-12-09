import React from 'react';
import View from '../View';
import GameStore from '../../../stores/GameStore';
import {
  Link,
} from 'react-router-dom';

export default class EveryoneView
extends View {
  _initialData() {
    return !GameStore.loadCharacters() && !GameStore.clearRole();
  }

  onGameStoreUpdate() {
    super.onGameStoreUpdate(
      GameStore.getCharacters()
    );
  }

  _eyebrow() {
    return 'This is';
  }

  _title() {
    return 'Everyone';
  }

  _renderContent() {
    return this.state.data.map(this._renderRelationship);
  }

  _renderRelationship(character) {
    return (
      <article className={this.bem.el('relationship')}>
        <Link
          className={this.bem.el('relationship', 'link')}
          to={`/reset/${character.slug}`}
        >
          <h1 className={this.bem.el('relationship', 'name')}>
            {character.involvement}. {character.full_name}
          </h1>

          <h2 className={this.bem.el('relationship', 'guest')}>
            {this._guestWithLastInitial(character.guest)}
          </h2>
        </Link>
      </article>
    );
  }

  _guestWithLastInitial(name) {
    var names = name.split(' ');

    names[names.length - 1] = `${names[names.length - 1][0]}.`;

    return names.join(' ');
  }
}
