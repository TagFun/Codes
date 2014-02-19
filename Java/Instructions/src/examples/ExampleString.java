package examples;

public class ExampleString {
	
	/**
	 * @author Nina | TagFun | http://www.jmdprojects.net/blog-tagfun
	 */

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		String x = "Nina Ranta";
		System.out.println("Hello " + x);
		System.out.println(x.toUpperCase());
		System.out.println(x.substring(2,7));
		System.out.println(x.charAt(3));
		
		String age = "22";
		String salary = "2700";
		// Wrapper classes
		int a = Integer.parseInt(age);
		System.out.println(a);
		
		int s = Integer.parseInt(salary);
		System.out.println(s + "€/kk");
	}

}
