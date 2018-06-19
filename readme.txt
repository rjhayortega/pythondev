javac -cp /stuff/lib/commons-lang-2.3.jar;. Howdy.java
This generates the Howdy.class file. In order to execute this class, we need to supply the classpath referencing commons-lang-2.3.jar to the java interpreter so that it knows what to do when the StringUtils.replace() method is called.

java -cp /stuff/lib/commons-lang-2.3.jar;. Howdy