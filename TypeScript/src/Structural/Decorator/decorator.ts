export interface Product {
  getDescription(): string;
  getPrice(): number;
}

export class BasicProduct implements Product {
  private name: string;
  private price: number;

  constructor(name: string, price: number) {
    this.name = name;
    this.price = price;
  }

  getDescription(): string {
    return this.name;
  }

  getPrice(): number {
    return this.price;
  }
}

export abstract class ProductDecorator implements Product {
  protected product: Product;

  constructor(product: Product) {
    this.product = product;
  }

  abstract getDescription(): string;
  abstract getPrice(): number;
}

export class GiftWrapDecorator extends ProductDecorator {
  getDescription(): string {
    return this.product.getDescription() + ', com embalagem de presente';
  }

  getPrice(): number {
    return this.product.getPrice() + 5.0; // Custo adicional de 5 reais para embalagem de presente
  }
}

export class ExtendedWarrantyDecorator extends ProductDecorator {
  getDescription(): string {
    return this.product.getDescription() + ', com garantia estendida';
  }

  getPrice(): number {
    return this.product.getPrice() + 20.0;
  }
}

const product = new BasicProduct('Produto A', 100.0);
console.log(`${product.getDescription()} - Preço: R$${product.getPrice()}`);

const giftWrappedProduct = new GiftWrapDecorator(product);
console.log(`${giftWrappedProduct.getDescription()} - Preço: R$${giftWrappedProduct.getPrice()}`);

const fullyFeaturedProduct = new ExtendedWarrantyDecorator(giftWrappedProduct);
console.log(`${fullyFeaturedProduct.getDescription()} - Preço: R$${fullyFeaturedProduct.getPrice()}`);
