@extends('app')
@section('titulo', 'Home')
@section('content')

<div class="home">
      <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />

      
      
      <div class="contenido">
        <div class="local">
          <div class="borde-rosa"></div>
          <img class="foto-local-2" alt="" src="../public/assets/img/foto-local-2@2x.png" />

          <img class="foto-local-1" alt="" src="../public/assets/img/foto-local-1@2x.png" />
          {{ $test }}
          <div class="desc-local">
            ¡Nuestro restaurante mexicano es como un viaje express a México, sin
            necesidad de pasaporte ni maletas! Te servimos tacos que hacen
            vibrar tus papilas gustativas y margaritas que hacen vibrar tu
            felicidad. ¡Ven a disfrutar de una fiesta de sabor con mariachis en
            tu plato!" 🌮🎉
          </div>
        </div>
        <div class="comida">
          <div class="borde-verde"></div>
          <div class="desc-taco">
            Imagina un taco mexicano tan increíble que podría hacer que un
            cactus sonría. Nuestro mejor taco es como un concierto de sabores en
            tu paladar. La carne se derrite en tu boca más suavemente que una
            serenata de mariachi y las salsas son más picantes que una fiesta de
            chiles. Cada bocado es una fiesta sorpresa, como un piñata de
            felicidad. ¡Este taco hará que tu estómago aplauda de alegría!
          </div>
          <img class="taco-icon" alt="" src="../public/assets/img/taco@2x.png" />
        </div>
        <div class="bebidas">
          <div class="borde-azul"></div>
          <div class="desc-coctel">
            Permíteme presentarte el 'Sabor de México', nuestro cóctel estrella
            que te hará regresar una y otra vez. Es como un viaje en un vaso: te
            sumerge en un mar de tequila de primera calidad, con un toque
            cítrico de limón y naranja, y un misterioso abrazo de nuestro licor
            secreto. ¡Es tan delicioso que te hará sentir como si estuvieras de
            vacaciones en las playas de Cancún! Cada sorbo es una invitación a
            la fiesta, y una razón más para volver a nuestro restaurante.
          </div>
          <img class="coctel-icon" alt="" src="../public/assets/img/coctel@2x.png" />
        </div>
      </div>
      <div class="descripcion">
        ¡Nuestro restaurante mexicano es como un viaje express a México, sin
        necesidad de pasaporte ni maletas! Te servimos tacos que hacen vibrar
        tus papilas gustativas y margaritas que hacen vibrar tu felicidad. ¡Ven
        a disfrutar de una fiesta de sabor con mariachis en tu plato!"
      </div>
      
    </div>
@endsection

