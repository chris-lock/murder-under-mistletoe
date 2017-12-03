import React from 'react';
import SubView from '../SubView';
import GameStore from '../../../stores/GameStore';

export default class StoryView
extends SubView {
  _initialData() {
    return !GameStore.loadStory();
  }

  onGameStoreUpdate() {
    super.onGameStoreUpdate(
      GameStore.getStory()
    );
  }

  _eyebrow() {
    return 'The Story';
  }

  _title() {
    return this.state.data.title;
  }

  _renderContent() {
    return (
      <div
        className={this.bem.el('section', 'copy').mod('main')}
        {...this.markdown(this.state.data.copy)}
      />
    );
  }
}
