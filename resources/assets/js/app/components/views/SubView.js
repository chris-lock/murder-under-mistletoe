import View from './View';

export default class SubView
extends View {
  shouldComponentUpdate(nextProps, nextState) {
    return this.state.data !== nextState.data;
  }
}
