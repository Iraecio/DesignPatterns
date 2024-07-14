export interface Observer {
  update(message: string): void;
}

export interface Observable {
  addObserver(observer: Observer): void;
  removeObserver(observer: Observer): void;
  notifyObservers(message: string): void;
}

export class Product implements Observable {
  private observers: Observer[] = [];
  private name: string;
  private price: number;

  constructor(name: string, price: number) {
    this.name = name;
    this.price = price;
  }

  addObserver(observer: Observer): void {
    this.observers.push(observer);
  }

  removeObserver(observer: Observer): void {
    const index = this.observers.indexOf(observer);
    if (index !== -1) {
      this.observers.splice(index, 1);
    }
  }

  notifyObservers(message: string): void {
    this.observers.forEach((observer) => observer.update(message));
  }

  setPrice(price: number): void {
    this.price = price;
    this.notifyObservers(`O preço do ${this.name} foi atualizado para ${this.price}`);
  }

  getPrice(): number {
    return this.price;
  }
}

export class User implements Observer {
  private name: string;

  constructor(name: string) {
    this.name = name;
  }

  update(message: string): void {
    console.log(`${this.name} recebeu a notificação: ${message}`);
  }
}

const produto = new Product('Produto A', 100);

const user1 = new User('João');
const user2 = new User('Maria');

produto.addObserver(user1);
produto.addObserver(user2);

produto.setPrice(120);
produto.setPrice(150);
