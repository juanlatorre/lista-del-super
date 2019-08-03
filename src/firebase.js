import firebase from "firebase/app";
import "firebase/firestore";

var firebaseConfig = {
  //firebase keys//
};

firebase.initializeApp(firebaseConfig);

export const db = firebase.firestore();
