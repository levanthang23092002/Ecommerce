import 'package:flutter/material.dart';
import 'package:mobile/json/constant.dart';
import 'package:mobile/pages/home.dart';
import 'package:mobile/theme/colors.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

class RootApp extends StatefulWidget {
  const RootApp({super.key});

  @override
  State<RootApp> createState() => _RootAppState();
}

class _RootAppState extends State<RootApp> {
  int activeTab = 0;
  AppBar? appbar;
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;

    return Scaffold(
      appBar: getAppBar(),
      bottomNavigationBar: getFooter(),
      floatingActionButton: FloatingActionButton(
        elevation: 4.0,
        backgroundColor: white,
        onPressed: () {
          Navigator.push(
              context, MaterialPageRoute(builder: (context) => const Card()));
        },
        child: const Icon(
          FontAwesomeIcons.shoppingBag,
          color: palm,
        ),
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      body: getBody(),
    );
  }

  PreferredSizeWidget? getAppBar() {
    switch (activeTab) {
      case 0:
        return AppBar(
          elevation: 0.8,
          backgroundColor: white,
          title: const Text(
            "Home",
            style: TextStyle(color: black),
          ),
        );

      case 1:
        {
          return AppBar(
            elevation: 0.8,
            backgroundColor: palm,
            title: const Text(
              "Category",
              style: TextStyle(color: black),
            ),
            leading: IconButton(
              icon: Image.asset('asset/images/logo_bookstore.png'),
              onPressed: () {
                Navigator.push(context,
                    MaterialPageRoute(builder: (context) => const home()));
              },
            ),
          );
        }
      case 2:
        return AppBar(
          elevation: 0.8,
          backgroundColor: white,
          title: const Text(
            "Favourite",
            style: TextStyle(color: black),
          ),
        );

      case 3:
        return AppBar(
          elevation: 0.8,
          backgroundColor: white,
          title: const Text(
            "Acount",
            style: TextStyle(color: black),
          ),
        );
    }
    return null;
  }

  Widget getBody() {
    return const SingleChildScrollView();
  }

  Widget getFooter() {
    return Container(
      height: 80,
      decoration: BoxDecoration(
          color: palm,
          border: Border(top: BorderSide(color: grey.withOpacity(0.2)))),
      child: Padding(
        padding: const EdgeInsets.only(left: 10, right: 10, top: 5),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          children: List.generate(itemsTab.length, (index) {
            return IconButton(
                onPressed: () {
                  setState(() {
                    activeTab = index;
                  });
                },
                icon: Icon(
                  itemsTab[index]["icon"],
                  size: itemsTab[index]["size"],
                  color: activeTab == index ? accent : white,
                ));
          }),
        ),
      ),
    );
  }
}
