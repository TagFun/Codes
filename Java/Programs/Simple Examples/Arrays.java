package examples;

public class Arrays {
	
	/**
	 * @param args
	 * @author Nina | Tagfun | http://www.jmdprojects.net/blog-tagfun
	 */


	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		/*int a = 10;
		int b = 20;
		int c, d, e;
		c = 30;
		d = 40; e = 50;*/
		
		int [] a = {10, 20, 30, 40, 50 };
		
		System.out.println(a[2] + " " + a[4]);
		System.out.println("--------");
		
		// enhanced for
		for(int temp: a) {
			System.out.println(temp);
		}
		System.out.println("----------");
		int [] x = new int[5];
		
		x[3] = 25;
		x[0] = 12;
		
		for(int temp2: x) {
			System.out.println(temp2);
		}
		System.out.println("----------");
		String[] st = {"one", "two", "three"};
		
		st[0] = "This";
		st[1] = "is";
		st[2] = "fun";
		
		System.out.println(st[0] + " " + st[1] + " " + st[2]);
		
		
		
	
	}

}
