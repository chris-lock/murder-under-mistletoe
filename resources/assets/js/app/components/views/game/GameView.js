import React from 'react';
import {
  Route,
} from 'react-router-dom';
import RootView from '../RootView';
import StoryView from './StoryView';
import ResetView from './ResetView';
import WelcomeView from './WelcomeView';
import CharacterView from './CharacterView';
import ActView from './ActView';

export default class GameView
extends RootView {
  static nav = {
    Story: '/',
    Role: '/role',
    Acts: '/acts',
  };

  _renderViews() {
    return [
      <Route path="/" exact component={StoryView} />,
      <Route path="/reset/:characterSlug" exact component={ResetView} />,
      <Route path="/welcome/:characterSlug" component={WelcomeView} />,
      <Route path="/role" exact component={CharacterView} />,
      <Route path="/characters/:characterSlug" component={CharacterView} />,
      <Route path="/acts" component={ActView} />,
    ];
  }
}
