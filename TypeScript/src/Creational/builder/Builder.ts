// example builder pattern

export abstract class PedidoBuilder {
  abstract makeCliente(): this;
  abstract makeProduto(): this;
  abstract makeQuantidade(): this;
  abstract makePrice(): this;
  abstract makeTotal(): this;
}

export class Pedido {
  cliente: string = '';
  produto: string = '';
  quantidade: number = 0;
  price: number = 0;
  total: number = 0;
}

export class PedidoBuilderImpl extends PedidoBuilder {
  private pedido: Pedido;

  constructor() {
    super();
    this.pedido = new Pedido();
  }

  makeCliente(): this {
    this.pedido.cliente = 'Cliente 1';
    return this;
  }

  makeProduto(): this {
    this.pedido.produto = 'Produto 1';
    return this;
  }

  makeQuantidade(): this {
    this.pedido.quantidade = 10;
    return this;
  }

  makePrice(): this {
    this.pedido.price = 100;
    return this;
  }

  makeTotal(): this {
    this.pedido.total = this.pedido.quantidade * this.pedido.price;
    return this;
  }

  build(): Pedido {
    return this.pedido;
  }

  toString(): string {
    return JSON.stringify(this.pedido);
  }
}

export class Demo {
  public static main(): void {
    const builder = new PedidoBuilderImpl();
    builder.makeCliente().makeProduto().makeQuantidade().makePrice().makeTotal();
    console.log(builder.toString());
  }
}

Demo.main();
