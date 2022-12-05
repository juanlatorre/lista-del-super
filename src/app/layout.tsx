import "../styles/global.css";

import Loading from "./loading";
import { Martel_Sans } from "@next/font/google";
import RootStyleRegistry from "./RootStyleRegistry";
import { Suspense } from "react";

const martel = Martel_Sans({
  weight: ["400", "700"],
  style: ["normal"],
  subsets: ["latin"],
});

export default function Layout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="es" className={martel.className}>
      <head />
      <Suspense fallback={<Loading />}>
        <body>
          <RootStyleRegistry>{children}</RootStyleRegistry>
        </body>
      </Suspense>
    </html>
  );
}
