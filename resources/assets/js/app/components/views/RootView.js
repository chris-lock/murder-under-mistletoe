import React from 'react';
import View from './View';
import {
  NavLink,
} from 'react-router-dom';

export default class RootView
extends View {
  static mod = 'root';
  static nav = {};

  render() {
    return (
      <div className={this.bem}>
        {this._renderNav()}

        <div
          children={this._renderViews()}
          className={this.bem.el('view').mod('sub')}
        />
      </div>
    );
  }

  _renderNav() {
    const names = Object.keys(this.constructor.nav);

    if (names.length) {
      return (
        <nav
          children={names.map(this._renderNavLink)}
          className={this.bem.el('nav')}
        />
      );
    }
  }

  _renderNavLink(name) {
    return (
      <NavLink
        activeClassName={`${this.bem.el('nav', 'link').mod('active')}`}
        children={name}
        className={`${this.bem.el('nav', 'link')}`}
        exact={this.constructor.nav[name] === this.props.match.url}
        to={this.constructor.nav[name]}
      />
    );
  }

  _renderViews() {
    return [];
  }
}
