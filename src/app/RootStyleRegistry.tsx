"use client";

import { ReactNode } from "react";
import { useServerInsertedHTML } from "next/navigation";
import { useStyledComponentsRegistry } from "../lib/styled-components";

export default function RootStyleRegistry({
  children,
}: {
  children: ReactNode;
}) {
  const [StyledComponentsRegistry, styledComponentsFlushEffect] =
    useStyledComponentsRegistry();

  useServerInsertedHTML(() => {
    return <>{styledComponentsFlushEffect()}</>;
  });

  return <StyledComponentsRegistry>{children}</StyledComponentsRegistry>;
}
