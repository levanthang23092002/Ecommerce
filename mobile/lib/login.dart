import 'package:mobile/signUp.dart';
import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      debugShowCheckedModeBanner: false,
      home: MyHomePage(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key});

  @override
  State<MyHomePage> createState() => _MyHomePage();
}

class _MyHomePage extends State<MyHomePage> {
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passController = TextEditingController();

  late bool _showpassword = false;
  @override
  Widget build(BuildContext context) {
    final Size size = MediaQuery.of(context).size;

    return Scaffold(
      body: SingleChildScrollView(
        child: Container(
          width: size.width,
          height: size.height,
          color: const Color.fromARGB(156, 255, 244, 223),
          child: Column(
            children: [
              Padding(
                  padding: const EdgeInsets.only(top: 20),
                  child: Image.asset(
                    'asset/images/logo-removebg-preview.png',
                    width: 200,
                    height: 200,
                  )),
              const Padding(
                padding: EdgeInsets.only(top: 20, bottom: 40),
                child: Text(
                  "Đăng nhập",
                  style: TextStyle(
                      color: Color.fromARGB(255, 0, 0, 0),
                      fontSize: 32,
                      fontWeight: FontWeight.w500,
                      shadows: [
                        Shadow(
                            blurRadius: 2.0,
                            color: Colors.grey,
                            offset: Offset(2, 2))
                      ]),
                ),
              ),
              inputText(
                _emailController,
                'Email...',
                const Icon(
                  Icons.email,
                  color: Color.fromRGBO(18, 84, 132, 0.612),
                ),
              ),
              inputText(
                  _passController,
                  'Password...',
                  const Icon(
                    Icons.key,
                    color: Color.fromRGBO(16, 75, 118, 0.612),
                  ),
                  IconButton(
                      onPressed: () {
                        setState(() {
                          _showpassword = !_showpassword;
                        });
                      },
                      icon: _showpassword
                          ? const Icon(Icons.remove_red_eye)
                          : const Icon(Icons.visibility_off),
                      color: const Color.fromRGBO(16, 75, 118, 0.612)),
                  _showpassword),
              InkWell(
                child: const Text(
                  'Quên mật khẩu ?',
                  style: TextStyle(
                      decoration: TextDecoration.underline,
                      fontSize: 16,
                      color: Color.fromARGB(255, 16, 200, 22)),
                ),
                onTap: () {
                  Navigator.push(context,
                      MaterialPageRoute(builder: (context) => const signUp()));
                },
              ),
              Padding(
                //button login
                padding: const EdgeInsets.only(
                    top: 50, left: 40, right: 40, bottom: 20),
                child: ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color.fromARGB(255, 16, 200, 22),
                    ),
                    onPressed: onSignInclicked,
                    child: const SizedBox(
                      height: 55,
                      width: 340,
                      child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Text(
                              'Đăng nhập ',
                              style: TextStyle(
                                  fontSize: 24, fontWeight: FontWeight.bold),
                            ),
                            Icon(
                              Icons.arrow_right_alt,
                              size: 30,
                            ),
                          ]),
                    )),
              ),
              Padding(
                padding: const EdgeInsets.only(bottom: 40.0),
                child: InkWell(
                  child: const Text(
                    'Đăng ký?',
                    style: TextStyle(
                        decoration: TextDecoration.underline,
                        fontSize: 16,
                        color: Color.fromARGB(255, 16, 200, 22)),
                  ),
                  onTap: () {
                    Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) => const signUp()));
                  },
                ),
              ),
              const Padding(
                padding: EdgeInsets.symmetric(horizontal: 40),
                child: Row(
                  children: <Widget>[
                    Expanded(
                        child: Divider(
                      color: Colors.black,
                    )),
                    Text(
                      '   OR   ',
                      style: TextStyle(fontWeight: FontWeight.bold),
                    ),
                    Expanded(
                        child: Divider(
                      color: Colors.black,
                    )),
                  ],
                ),
              ),
              Padding(
                padding: const EdgeInsets.only(top: 20),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceAround,
                  children: <Widget>[
                    Column(
                      children: [
                        IconButton(
                            onPressed: () {},
                            icon: Image.asset(
                              "asset/icons/facebook.png",
                            )),
                        const Text(
                          "Login with facebook",
                          style: TextStyle(fontStyle: FontStyle.italic),
                        )
                      ],
                    ),
                    Column(
                      children: [
                        IconButton(
                            onPressed: () {},
                            icon: Image.asset(
                              "asset/icons/google.png",
                            )),
                        const Text(
                          "Login with google",
                          style: TextStyle(fontStyle: FontStyle.italic),
                        )
                      ],
                    ),
                  ],
                ),
              )
            ],
          ),
        ),
      ),
    );
  }

  inputText(TextEditingController controller, String lable, Widget icon,
      [Widget? eye, bool obscureTexts = false]) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 35, vertical: 20),
      child: Material(
        borderRadius: const BorderRadius.only(
          topLeft: Radius.circular(12),
          topRight: Radius.circular(12),
        ),
        elevation: 18,
        shadowColor: Colors.grey,
        child: TextField(
          controller: controller,
          textInputAction: TextInputAction.none,
          style: const TextStyle(fontSize: 20),
          decoration: InputDecoration(
              filled: true,
              fillColor: const Color.fromARGB(156, 232, 232, 232),
              prefixIcon: icon,
              suffixIcon: eye,
              border: const UnderlineInputBorder(
                borderRadius: BorderRadius.only(
                  topLeft: Radius.circular(12),
                  topRight: Radius.circular(12),
                ),
              ),
              label: Text(lable),
              labelStyle: const TextStyle(color: Colors.grey)),
          obscureText: obscureTexts,
        ),
      ),
    );
  }

  void onSignInclicked() {}
}
