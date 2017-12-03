import {
  Component as React$Component,
} from 'react';
import Bem from '../utilities/Bem';

export default class Component
extends React$Component {
  static className = '';

  bem = new Bem(this.props.className || this.constructor.className);

  componentWillReceiveProps(nextProps) {
    if (this.props.className !== nextProps.className) {
      this.bem = new Bem(nextProps.className);
    }
  }
}
