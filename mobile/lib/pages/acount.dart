import 'package:flutter/material.dart';
import 'package:mobile/theme/colors.dart';

class Acount extends StatefulWidget {
  const Acount({super.key});

  @override
  State<Acount> createState() => _AcountState();
}

class _AcountState extends State<Acount> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        floatingActionButton: FloatingActionButton(
            elevation: 4.0,
            backgroundColor: palm,
            onPressed: () {},
            child: const Icon(
              Icons.update,
            )));
  }
}
