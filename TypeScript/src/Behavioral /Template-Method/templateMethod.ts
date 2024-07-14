export abstract class HotBeverage {
  prepareBeverage(): void {
    this.boilWater();
    this.brew();
    this.pourInCup();
    this.addCondiments();
  }

  abstract brew(): void;
  abstract addCondiments(): void;

  boilWater(): void {
    console.log('Fervendo água');
  }

  pourInCup(): void {
    console.log('Despejando a bebida na xícara');
  }
}

export class Tea extends HotBeverage {
  brew(): void {
    console.log('Infundindo o chá');
  }

  addCondiments(): void {
    console.log('Adicionando limão');
  }
}

export class Coffee extends HotBeverage {
  brew(): void {
    console.log('Passando café');
  }

  addCondiments(): void {
    console.log('Adicionando açúcar e leite');
  }
}

const tea = new Tea();
console.log('Preparando chá:');
tea.prepareBeverage();

console.log('---');

const coffee = new Coffee();
console.log('Preparando café:');
coffee.prepareBeverage();
