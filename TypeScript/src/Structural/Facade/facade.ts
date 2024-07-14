export class Inventory {
  private stock: { [key: string]: number } = {};

  addProduct(name: string, quantity: number): void {
    if (!this.stock[name]) {
      this.stock[name] = 0;
    }
    this.stock[name] += quantity;
    console.log(`Adicionado ${quantity} unidades de ${name} ao inventário.`);
  }

  removeProduct(name: string, quantity: number): void {
    if (this.stock[name] >= quantity) {
      this.stock[name] -= quantity;
      console.log(`Removido ${quantity} unidades de ${name} do inventário.`);
    } else {
      console.log(`Estoque insuficiente para remover ${quantity} unidades de ${name}.`);
    }
  }

  getStock(name: string): number {
    return this.stock[name] || 0;
  }
}

export class Pricing {
  private prices: { [key: string]: number } = {};

  setPrice(name: string, price: number): void {
    this.prices[name] = price;
    console.log(`O preço de ${name} foi definido para R$${price}.`);
  }

  getPrice(name: string): number {
    return this.prices[name] || 0;
  }
}

export class Shipping {
  shipProduct(name: string, quantity: number): void {
    console.log(`Enviando ${quantity} unidades de ${name}.`);
  }
}

export class ProductFacade {
  private inventory: Inventory;
  private pricing: Pricing;
  private shipping: Shipping;

  constructor() {
    this.inventory = new Inventory();
    this.pricing = new Pricing();
    this.shipping = new Shipping();
  }

  addProduct(name: string, quantity: number, price: number): void {
    this.inventory.addProduct(name, quantity);
    this.pricing.setPrice(name, price);
  }

  shipProduct(name: string, quantity: number): void {
    if (this.inventory.getStock(name) >= quantity) {
      this.shipping.shipProduct(name, quantity);
      this.inventory.removeProduct(name, quantity);
    } else {
      console.log(`Estoque insuficiente para enviar ${quantity} unidades de ${name}.`);
    }
  }

  getProductInfo(name: string): void {
    const stock = this.inventory.getStock(name);
    const price = this.pricing.getPrice(name);
    console.log(`Produto: ${name}, Estoque: ${stock}, Preço: R$${price}`);
  }
}

const productFacade = new ProductFacade();

productFacade.addProduct('Produto A', 100, 50);
productFacade.addProduct('Produto B', 200, 30);
productFacade.getProductInfo('Produto A');
productFacade.getProductInfo('Produto B');
productFacade.shipProduct('Produto A', 20);
productFacade.shipProduct('Produto B', 50);
productFacade.getProductInfo('Produto A');
productFacade.getProductInfo('Produto B');
