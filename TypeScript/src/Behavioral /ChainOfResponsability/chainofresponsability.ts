export interface DiscountHandler {
  setNext(handler: DiscountHandler): void;
  handle(price: number): number;
}

export class TenPercentHandler implements DiscountHandler {
  private nextHandler: DiscountHandler | null = null;

  setNext(handler: DiscountHandler): void {
    this.nextHandler = handler;
  }

  handle(price: number): number {
    if (price > 100) {
      const discountedPrice = price * 0.9;
      console.log(`Desconto de 10% aplicado (preço maior que 100): ${discountedPrice}`);
      return discountedPrice;
    } else if (this.nextHandler) {
      return this.nextHandler.handle(price);
    } else {
      console.log('Nenhum desconto aplicável.');
      return price;
    }
  }
}

export class FiftyPercentHandler implements DiscountHandler {
  private nextHandler: DiscountHandler | null = null;

  setNext(handler: DiscountHandler): void {
    this.nextHandler = handler;
  }

  handle(price: number): number {
    if (price > 500) {
      const discountedPrice = price * 0.5;
      console.log(`Desconto de 50% aplicado (preço maior que 500): ${discountedPrice}`);
      return discountedPrice;
    } else if (this.nextHandler) {
      return this.nextHandler.handle(price);
    } else {
      console.log('Nenhum desconto aplicável.');
      return price;
    }
  }
}

const tenPercentHandler = new TenPercentHandler();
const fiftyPercentHandler = new FiftyPercentHandler();

tenPercentHandler.setNext(fiftyPercentHandler);

const productPrice1 = 120;
console.log(`Preço original do produto 1: ${productPrice1}`);
const discountedPrice1 = tenPercentHandler.handle(productPrice1);
console.log(`Preço com desconto do produto 1: ${discountedPrice1}`);

console.log('---');

const productPrice2 = 600;
console.log(`Preço original do produto 2: ${productPrice2}`);
const discountedPrice2 = tenPercentHandler.handle(productPrice2);
console.log(`Preço com desconto do produto 2: ${discountedPrice2}`);
