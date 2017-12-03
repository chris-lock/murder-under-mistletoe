import React from 'react';
import Component from '../../Component';
import {
  Redirect,
} from 'react-router-dom';

export default class StoryView
extends Component {
  componentWillMount() {
    GameStore.clearRole();
  }

  render() {
    return (
      <Redirect to={`/welcome/${this.props.match.params.characterSlug}`} />
    );
  }
}
