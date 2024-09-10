#include <stdio.h>

float soma(float a, float b);

float subtracao(float a, float b);

float multiplicacao(float a, float b);

float divisao(float a, float b);

float potenciacao(float base, int expoente);

float raizQuadrada(float n);

int fatorial(int n);

int mdc(int a, int b);

int mmc(int a, int b);

void equacaoSegundoGrau(float a, float b, float c);

int main() {
    int escolha;
    float num1;
    float num2;
    int numInt1;
    int numInt2;

    do {
        printf("Escolha a operacao desejada:\n");
        printf("0. Sair\n");
        printf("1. Soma\n");
        printf("2. Subtracao\n");
        printf("3. Multiplicacao\n");
        printf("4. Divisao\n");
        printf("5. Potenciacao\n");
        printf("6. Raiz Quadrada\n");
        printf("7. Fatorial\n");
        printf("8. MDC\n");
        printf("9. MMC\n");
        printf("10. Equacao de Segundo Grau\n");
        printf("Digite a sua escolha: ");
        scanf("%d", &escolha);

        if(escolha==0){
                printf("Saindo");
        }
        else if(escolha==1){
                printf("Digite um numero: ");
                scanf("%f", &num1);
                printf("Digite outro numero: ");
                scanf("%f", &num2);
                printf("Resultado: %.5f + %.5f = %.5f\n", num1, num2, soma(num1, num2));

        }
        else if(escolha==2){
                printf("Digite um numero: ");
                scanf("%f", &num1);
                printf("Digite outro numero: ");
                scanf("%f", &num2);
                printf("Resultado: %.5f - %.5f = %.5f\n", num1, num2, subtracao(num1, num2));

        }
        else if(escolha==3){
                printf("Digite um numero: ");
                scanf("%f", &num1);
                printf("Digite outro numero: ");
                scanf("%f", &num2);
                printf("Resultado: %.5f * %.5f = %.5f\n", num1, num2, multiplicacao(num1, num2));

        }
        else if(escolha==4){
                printf("Digite um numero: ");
                scanf("%f", &num1);
                printf("Digite outro numero: ");
                scanf("%f", &num2);
                if (num2 != 0) {
                    printf("Resultado: %.5f / %.5f = %.5f\n", num1, num2, divisao(num1, num2));
                } else {
                    printf("Erro: Divisao por zero!\n");
                }
        }
        else if(escolha==5){
                printf("Digite a base: ");
                scanf("%f", &num1);
                printf("Digite o expoente: ");
                scanf("%d", &numInt1);
                printf("Resultado: %.5lf ^ %d = %.5f\n", num1, numInt1, potenciacao(num1, numInt1));
        }
        else if(escolha==6){
                printf("Digite o numero: ");
                scanf("%f", &num1);
                if (num1 >= 0) {
                    printf("Resultado: sqrt(%.5f) = %.5f\n", num1, raizQuadrada(num1));
                } else {
                    printf("Erro: A raiz quadrada de um numero negativo nao existe.\n");
                }
        }
        else if(escolha==7){
                printf("Digite o numero: ");
                scanf("%d", &numInt1);
                if (numInt1 >= 0) {
                    printf("Resultado: %d! = %d\n", numInt1, fatorial(numInt1));
                } else {
                    printf("Erro: Fatorial de numero negativo nao definido.\n");
                }
        }
        else if(escolha==8){
                printf("Digite o primeiro numero: ");
                scanf("%d", &numInt1);
                printf("Digite o segundo numero: ");
                scanf("%d", &numInt2);
                printf("Resultado: MDC(%d, %d) = %d\n", numInt1, numInt2, mdc(numInt1, numInt2));
        }
        else if (escolha==9){
            printf("Digite o primeiro numero: ");
                scanf("%d", &numInt1);
                printf("Digite o segundo numero: ");
                scanf("%d", &numInt2);
                printf("Resultado: MMC(%d, %d) = %d\n", numInt1, numInt2, mmc(numInt1, numInt2));
        }
        else if(escolha==10){
                printf("Digite o coeficiente a: ");
                scanf("%f", &num1);
                printf("Digite o coeficiente b: ");
                scanf("%f", &num2);
                printf("Digite o coeficiente c: ");
                scanf("%d", &numInt1);
                equacaoSegundoGrau(num1, num2, numInt1);
        }
        else{
                printf("Opcao invalida!\n");
                break;
        }
    } while (escolha != 0);

    return 0;

}


float soma(float a, float b) {
    return a + b;
}

float subtracao(float a, float b) {
    return a - b;
}

float multiplicacao(float a, float b) {
    return a * b;
}

float divisao(float a, float b) {
    return a / b;
}

float potenciacao(float base, int expoente) {
    double resultado = 1;
    for (int i = 0; i < expoente; i++) {
        resultado *= base;
    }
    return resultado;
}

float raizQuadrada(float n) {
    float x = n;
    float precisao = 1e-10;
    while ((x * x - n) > precisao || (x * x - n) < -precisao) {
        x = 0.5 * (x + n / x);
    }
    return x;
}

int fatorial(int n) {
    if (n == 0) return 1;
    int resultado = 1;
    for (int i = 1; i <= n; i++) {
        resultado *= i;
    }
    return resultado;
}

int mdc(int a, int b) {
    while (b != 0) {
        int temp = b;
        b = a % b;
        a = temp;
    }
    return a;
}

int mmc(int a, int b) {
    return (a * b) / mdc(a, b);
}

void equacaoSegundoGrau(float a, float b, float c) {
    double delta = b * b - 4 * a * c;
    if (delta < 0) {
        printf("Nao ha solucoes reais para a equacao.\n");
    } else {
        double x1 = (-b + raizQuadrada(delta)) / (2 * a);
        double x2 = (-b - raizQuadrada(delta)) / (2 * a);
        printf("Raizes da equacao: x1 = %.5lf e x2 = %.5lf\n", x1, x2);
    }
}

