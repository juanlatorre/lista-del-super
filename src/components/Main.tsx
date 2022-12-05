"use client";

import breakpoints from "../lib/breakpoints";
import styled from "styled-components";

const Main = styled.main`
  text-align: center;
  padding: 2em;
  font-size: 1.4rem;

  @media (${breakpoints.mobile}) {
    font-size: 1rem;
  }
`;

export default Main;
