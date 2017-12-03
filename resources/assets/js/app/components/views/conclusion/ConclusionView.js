import React from 'react';
import {
  Route,
} from 'react-router-dom';
import RootView from '../RootView';
import ExplanationView from './ExplanationView';
import PointsView from './PointsView';

export default class ConclusionView
extends RootView {
  static nav = {
    Conclusion: '/conclusion',
    Points: '/conclusion/points',
  };

  _renderViews() {
    return [
      <Route exact path={`${this.props.match.url}`} component={ExplanationView} />,
      <Route path={`${this.props.match.url}/points`} component={PointsView} />,
    ];
  }
}
