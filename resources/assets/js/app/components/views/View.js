import React from 'react';
import Component from '../Component';
import Bem from '../../utilities/Bem';
import GameStore from '../../stores/GameStore';
import {
  markdown,
} from 'markdown';

export default class View
extends Component {
  bem = new Bem('view').optional().mod(this.constructor.mod);
  state = {};

  componentDidMount() {
    GameStore.subscribe(this.onGameStoreUpdate);

    if (!this._initialData()) {
      this.onGameStoreUpdate({});
    }
  }

  onGameStoreUpdate(data) {
    if (!GameStore.getRole()) {
      this.setState({
        data: {
          error: true,
        },
      });
    } else if (data) {
      this.setState({
        data,
      });
    }
  }

  _initialData() {}

  componentWillUnmount() {
    GameStore.unsubscribe(this.onGameStoreUpdate);
  }

  render() {
    const view = this._renderViewIfLoaded();

    return (
      <article
        children={view}
        className={this.bem.conditional(!view).state('loading')}
      />
    );
  }

  _renderViewIfLoaded() {
    if (this.state.data) {
      return (this.state.data.error)
        ? this._renderNoRole()
        : this._renderView();
    }
  }

  _renderNoRole() {
    return this._renderTitleSection('Sorry', 'No peeking');
  }

  _renderTitleSection(eyebrow, title) {
    return (
      <h1 className={this.bem.el('title')}>
        <span className={this.bem.el('title', 'inner')}>
          {this._renderEyebrow(eyebrow)}

          {title}
        </span>
      </h1>
    );
  }

  _renderEyebrow(eyebrow) {
    if (eyebrow) {
      return (
        <span
          children={eyebrow}
          className={this.bem.el('title', 'eyebrow')}
        />
      );
    }
  }

  _renderView() {
    return [
      this._renderTitleSection(this._eyebrow(), this._title()),

      <div className={this.bem.el('content')}>
        <div className={this.bem.el('content', 'main')}>
          <div className={this.bem.el('content', 'outer')}>
            <div className={this.bem.el('content', 'inner')}
              children={this._renderContent()}
            />
          </div>
        </div>
      </div>,
    ];
  }

  _eyebrow() {}

  _title() {}

  _renderContent() {}

  markdown(raw) {
    return {
      dangerouslySetInnerHTML: {
        __html: markdown.toHTML(raw),
      },
    };
  }

  renderSection(title, content) {
    return (
      <div className={this.bem.el('section')}>
        <h1 className={this.bem.el('section', 'title')}>
          <span
            children={title}
            className={this.bem.el('section', 'title', 'inner')}
          />
        </h1>

        <div
          children={content}
          className={this.bem.el('section', 'content')}
        />
      </div>
    );
  }
}
