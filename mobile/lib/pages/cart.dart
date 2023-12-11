import 'package:flutter/material.dart';
import 'package:mobile/theme/colors.dart';

class Cart extends StatefulWidget {
  const Cart({super.key});

  @override
  State<Cart> createState() => _CartState();
}

class _CartState extends State<Cart> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Cart"),
        backgroundColor: success,
      ),
      body: Container(
        color: Colors.amber,
      ),
    );
  }
}
