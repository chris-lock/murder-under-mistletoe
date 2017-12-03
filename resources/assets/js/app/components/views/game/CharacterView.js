import React from 'react';
import View from '../View';
import GameStore from '../../../stores/GameStore';
import {
  Link,
} from 'react-router-dom';

export default class CharacterView
extends View {
  _initialData() {
    return !GameStore.loadCharacter(this._characterSlug());
  }

  _characterSlug() {
    return this.props.match.params.characterSlug || GameStore.roleSlug;
  }

  onGameStoreUpdate() {
    super.onGameStoreUpdate(
      GameStore.getCharacter(this._characterSlug())
    );
  }

  _eyebrow() {
    return (this._isRole())
      ? 'Your Role'
      : this.state.data.guest;
  }

  _isRole() {
    return this.state.data.slug === GameStore.roleSlug;
  }

  _title() {
    return this.state.data.full_name;
  }

  _renderContent() {
    return [
      this.renderSection(
        'Bio',
        <div
          className={this.bem.el('section', 'copy').mod('main')}
          {...this.markdown(this.state.data.bio)}
        />
      ),
    ].concat(this._renderRoleContent());
  }

  _renderRoleContent() {
    if (this._isRole()) {
      return [
        this.renderSection(
          'Appearance & Mannerisms',
          <div
            className={this.bem.el('section', 'copy')}
            {...this.markdown(this.state.data.appearance)}
          />
        ),
        this._renderStory(),
        this._renderRelationships(),
      ]
    }
  }

  _renderStory() {
    if (this.state.data.story !== 'story') {
      return this.renderSection(
        'Story & Motive',
        <div
          className={this.bem.el('section', 'copy')}
          {...this.markdown(this.state.data.story)}
        />
      );
    }
  }

  _renderRelationships() {
    if (this.state.data.relationships.length) {
      return this.renderSection(
        'Relationships',
        <ul
          className={this.bem.el('relationships')}
          children={this.state.data.relationships.map(this._renderRelationship)}
        />
      );
    }
  }

  _renderRelationship(relationship) {
    return (
      <article className={this.bem.el('relationship')}>
        <Link
          className={this.bem.el('relationship', 'link')}
          to={`/characters/${relationship.character.slug}`}
        >
          <h1 className={this.bem.el('relationship', 'name')}>
            {relationship.character.full_name}
          </h1>

          <h2 className={this.bem.el('relationship', 'guest')}>
            {this._guestWithLastInitial(relationship.character.guest)}
          </h2>
        </Link>

        <div
           className={this.bem.el('relationship', 'description')}
          {...this.markdown(relationship.description)}
        />
      </article>
    );
  }

  _guestWithLastInitial(name) {
    var names = name.split(' ');

    names[names.length - 1] = `${names[names.length - 1][0]}.`;

    return names.join(' ');
  }
}
