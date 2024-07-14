export interface Button {
  paint(): void;
}

export interface Checkbox {
  paint(): void;
}

export class DarkButton implements Button {
  paint(): void {
    console.log('Rendering a dark-themed button.');
  }
}

export class DarkCheckbox implements Checkbox {
  paint(): void {
    console.log('Rendering a dark-themed checkbox.');
  }
}
export class LightButton implements Button {
  paint(): void {
    console.log('Rendering a light-themed button.');
  }
}
export class LightCheckbox implements Checkbox {
  paint(): void {
    console.log('Rendering a light-themed checkbox.');
  }
}
export interface UIFactory {
  createButton(): Button;
  createCheckbox(): Checkbox;
}
export class DarkUIFactory implements UIFactory {
  createButton(): Button {
    return new DarkButton();
  }

  createCheckbox(): Checkbox {
    return new DarkCheckbox();
  }
}
export class LightUIFactory implements UIFactory {
  createButton(): Button {
    return new LightButton();
  }

  createCheckbox(): Checkbox {
    return new LightCheckbox();
  }
}
function configureUI(factory: UIFactory) {
  const button = factory.createButton();
  const checkbox = factory.createCheckbox();

  button.paint();
  checkbox.paint();
}

const isDarkTheme = true;

const factory: UIFactory = isDarkTheme ? new DarkUIFactory() : new LightUIFactory();
configureUI(factory);
