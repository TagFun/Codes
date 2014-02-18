package examples;

//Class name
public class Demo {
	
	// function for result and returning it
	public static int summation(int n) {
		// result formula
		int result = (n *(n + 1)) / 2;
		
		// returning result value
		return result;	
	}
	
	// main function where everything happens
	public static void main(String[] args) {
		int input = 3;
		
		// summation(3);
		int finalResult = summation(input);
		
		// prints out (3*(3+1)) / 2 = 6
		System.out.print(finalResult);
	}

}
