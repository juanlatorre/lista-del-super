import AddItemWrapper from "../components/AddItemWrapper";
import Button from "../components/Button";
import { H1 } from "../components/Heading";
import Input from "../components/Input";
import Main from "../components/Main";

export default function Home() {
  return (
    <div>
      <Main>
        <H1>Lista de Supermercado</H1>

        <AddItemWrapper>
          <Input placeholder="Agregar..." noRightBorder />
          <Button noLeftBorder>+</Button>
        </AddItemWrapper>
      </Main>
    </div>
  );
}
