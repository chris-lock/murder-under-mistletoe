import React from 'react';
import SubView from '../SubView';
import GameStore from '../../../stores/GameStore';

export default class ActView
extends SubView {
  state = this._setCurrentStateTime();
  _timeInterval = null;

  _setCurrentStateTime() {
    return {
      time: Date.now(),
    };
  }

  shouldComponentUpdate(nextProps, nextState) {
    return this.state.time !== nextState.time;
  }

  componentDidMount() {
    super.componentDidMount();

    this._timeInterval = setInterval(() => {
      this.setState(this._setCurrentStateTime());
    }, 1000);
  }

  _initialData() {
    return !GameStore.loadActs();
  }

  onGameStoreUpdate() {
    super.onGameStoreUpdate(
      GameStore.getActs()
    );
  }

  componentWillUnmount() {
    super.componentWillUnmount();

    clearInterval(this._timeInterval);
  }

  _eyebrow() {
    if (this.state.data.length) {
      let date = new Date(this.state.data[0].begins);

      return date.toLocaleTimeString('en', {
        month: 'long',
        day: 'numeric',
      }).replace(`, ${date.toLocaleTimeString('en')}`, '');
    }
  }

  _title() {
    return 'Acts';
  }

  _renderContent() {
    return this.state.data.map(this._renderStartedActs);
  }

  _renderStartedActs(act, index) {
    return this._actHasStarted(act)
      ? this._renderAct(act, index)
      : this._renderSchedule(act, index);
  }

  _renderAct(act, index) {
    return (
      <article className={this.bem.el('act').conditional(this._actIsActive(act)).state('active')}>
        <h1 className={this.bem.el('act', 'title')}>
          <span className={this.bem.el('act', 'title', 'inner')}>
            {this._actEyebrow(index)}
          </span>

          <span className={this.bem.el('act', 'title', 'copy')}>
            {act.title}
          </span>
        </h1>

        <ul
          children={act.instructions.map(this._renderInstruction.bind(this, act))}
          className={this.bem.el('act', 'instructions')}
        />
      </article>
    );
  }

  _actEyebrow(index) {
    return `Act ${index + 1}`;
  }

  _actIsActive(act) {
    return (
      this._actHasStarted(act)
      && act.instructions.some((instruction) => instruction.completed === null)
    );
  }

  _actHasStarted(act) {
    return (
      act.begins <= this.state.time
      || GameStore.showEveryone()
    );
  }

  _renderInstruction(act, instruction) {
    return (
      <li
        className={this.bem.el('act', 'instruction')}
        {...this.markdown(instruction.copy)}
      />
    );
  }

  _renderSchedule(act, index) {
    return (
      <article className={this.bem.el('schedule')}>
        <h1 className={this.bem.el('schedule', 'act')}>
          <span className={this.bem.el('schedule', 'act', 'inner')}>
            {this._actEyebrow(index)}
          </span>
        </h1>

        <p className={this.bem.el('schedule', 'start')}>
          {this._actStartTime(act)}
        </p>
      </article>
    );
  }

  _actStartTime(act) {
    return new Date(act.begins).toLocaleTimeString('en', {
      hour: '2-digit',
      minute:'2-digit',
    });
  }
}
