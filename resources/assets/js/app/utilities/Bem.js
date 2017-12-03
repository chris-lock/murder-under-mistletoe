
class BaseBem {
  className;

  constructor(className) {
    this.className = (className || '').toString();
  }

  element(elementName, ...elementNames) {
    elementNames.unshift(this._rootClassName(), elementName);

    return new Bem(elementNames.join('__'));
  }

  modifier(modifierName) {
    return new Bem(`${this.className}--${modifierName}`);
  }

  state(stateName) {
    return `${this.modifier(stateName).get()} ${this.get()}`;
  }

  get() {
    return this.className;
  }

  toString() {
    return this.get();
  }

  _rootClassName() {
    return this.className.split(' ').pop();
  }
}

export default class Bem
extends BaseBem {
  conditional(condition) {
    return new ConditionalBem(this.className, condition);
  }
  el = this.element;

  optional() {
    return new OptionalBem(this.className);
  }
  mod = this.modifier;
}

class ConditionalBem
extends BaseBem {
  condition;

  constructor(className, condition) {
    super(className);

    this.condition = condition;
  }

  element(elementName) {
    return (this.condition)
      ? super.element(elementName)
      : new Bem(this.className);
  }
  el = this.element;

  modifier(modifierName) {
    return (this.condition)
      ? super.modifier(modifierName)
      : new Bem(this.className);
  }
  mod = this.modifier;

  state(stateName) {
    return (this.condition)
      ? super.state(stateName)
      : this.get();
  }
}

class OptionalBem
extends BaseBem {
  element(elementName, ...elementNames) {
    return (elementName)
      ? super.element(elementName, ...elementNames)
      : new Bem(this.className);
  }
  el = this.element;

  modifier(modifierName) {
    return (modifierName)
      ? super.modifier(modifierName)
      : new Bem(this.className);
  }
  mod = this.modifier;

  state(stateName) {
    return (stateName)
      ? super.state(stateName)
      : this.get();
  }
}
