
import java.io.File;

import org.bitcoinj.wallet.Wallet;

/**
 * DumpWallet loads a serialized wallet and prints information about what it contains.
 */
public class DumpWallet {
    public static void main(String[] args) throws Exception {
        if (args.length != 1) {
            System.out.println("Usage: java DumpWallet <filename>");
            return;
        }                     

        Wallet wallet = Wallet.loadFromFile(new File(args[0]));
        System.out.println(wallet.freshReceiveAddress().toString());
    
	  System.out.println(wallet.getBalance());
    }
}
