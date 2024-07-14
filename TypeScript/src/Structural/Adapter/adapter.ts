export interface IOldProduct {
  getName(): string;
  getPrice(): number;
}

export class OldProduct {
  private name: string;
  private price: number;

  constructor(name: string, price: number) {
    this.name = name;
    this.price = price;
  }

  getName(): string {
    return this.name;
  }

  getPrice(): number {
    return this.price;
  }
}

export class NewProduct {
  private productName: string;
  private productPrice: number;

  constructor(productName: string, productPrice: number) {
    this.productName = productName;
    this.productPrice = productPrice;
  }

  getProductName(): string {
    return this.productName;
  }

  getProductPrice(): number {
    return this.productPrice;
  }
}

export class ProductAdapter implements IOldProduct {
  private newProduct: NewProduct;

  constructor(newProduct: NewProduct) {
    this.newProduct = newProduct;
  }

  getName(): string {
    return this.newProduct.getProductName();
  }

  getPrice(): number {
    return this.newProduct.getProductPrice();
  }
}

function displayProduct(product: IOldProduct) {
  console.log(`Nome do Produto: ${product.getName()}`);
  console.log(`Preço do Produto: ${product.getPrice()}`);
}

const oldProduct = new OldProduct('Produto Antigo', 100);
const newProduct = new NewProduct('Produto Novo', 150);

displayProduct(oldProduct);

const adaptedProduct = new ProductAdapter(newProduct);
displayProduct(adaptedProduct);
