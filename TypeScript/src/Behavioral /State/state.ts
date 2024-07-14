export interface PackageState {
  updateState(context: PackageContext): void;
}

export class PendingState implements PackageState {
  updateState(context: PackageContext): void {
    console.log('A encomenda está pendente de envio.');
    context.setState(new ShippedState());
  }
}

export class ShippedState implements PackageState {
  updateState(context: PackageContext): void {
    console.log('A encomenda foi enviada.');
    context.setState(new DeliveredState());
  }
}

export class DeliveredState implements PackageState {
  updateState(context: PackageContext): void {
    console.log('A encomenda foi entregue com sucesso.');
  }
}

export class PackageContext {
  private state: PackageState;

  constructor() {
    this.state = new PendingState();
  }

  setState(state: PackageState): void {
    this.state = state;
  }

  update(): void {
    this.state.updateState(this);
  }
}

const packageContext = new PackageContext();

packageContext.update();
packageContext.update();
packageContext.update();
