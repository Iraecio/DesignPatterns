export interface Mediator {
  notify(sender: object, event: string): void;
}

export interface Colleague {
  setMediator(mediator: Mediator): void;
}

export class ProductMediator implements Mediator {
  private product: Product;
  private display: ProductDisplay;
  private stock: ProductStock;

  setColleagues(product: Product, display: ProductDisplay, stock: ProductStock): void {
    this.product = product;
    this.display = display;
    this.stock = stock;

    this.product.setMediator(this);
    this.display.setMediator(this);
    this.stock.setMediator(this);
  }

  notify(sender: object, event: string): void {
    if (event === 'priceChanged') {
      console.log('O preço do produto mudou. Atualizando display...');
      this.display.update();
    } else if (event === 'stockChanged') {
      console.log('O estoque do produto mudou. Atualizando display...');
      this.display.update();
    }
  }
}

export class Product implements Colleague {
  private mediator: Mediator;
  private price: number;

  constructor() {
    this.price = 0;
  }

  setMediator(mediator: Mediator): void {
    this.mediator = mediator;
  }

  setPrice(price: number): void {
    this.price = price;
    console.log(`Preço do produto definido para: ${this.price}`);
    this.mediator.notify(this, 'priceChanged');
  }

  getPrice(): number {
    return this.price;
  }
}

export class ProductDisplay implements Colleague {
  private mediator: Mediator;
  private product: Product;

  setMediator(mediator: Mediator): void {
    this.mediator = mediator;
  }

  setProduct(product: Product): void {
    this.product = product;
  }

  update(): void {
    console.log(`Display atualizado. Preço atual: ${this.product.getPrice()}`);
  }
}

export class ProductStock implements Colleague {
  private mediator: Mediator;
  private stock: number;

  setMediator(mediator: Mediator): void {
    this.mediator = mediator;
  }

  setStock(stock: number): void {
    this.stock = stock;
    console.log(`Estoque do produto definido para: ${this.stock}`);
    this.mediator.notify(this, 'stockChanged');
  }

  getStock(): number {
    return this.stock;
  }
}

const product = new Product();
const display = new ProductDisplay();
const stock = new ProductStock();
const mediator = new ProductMediator();
mediator.setColleagues(product, display, stock);
display.setProduct(product);
product.setPrice(150);
stock.setStock(20);
