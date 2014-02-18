package examples;

public class ExampleAndOr {
	
	/**
	 * @param args
	 * @author Nina | Tagfun | http://www.jmdprojects.net/blog-tagfun
	 */

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int x, y;
		x = 10;
		y = -10;
		
		if(x > 0 && y > 0) {
			System.out.println(" Both nums are +ve");
		
		}
		
		else if (x > 0 || y > 0) {
			System.out.println(" atleast one num is +ve");
		}
		
		else {
			System.out.println(" Both nums are -ve");
		}
	}
}