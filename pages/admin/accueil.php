<?php 
    @include_once("environnement.php");
    // $user = $_SESSION["globalUser"];

    $request = $bdd -> query("SELECT * 
                              FROM projet 
                              INNER JOIN type_offre 
                              ON type_id = type_offre.id");

    $data = $request -> fetchAll(PDO::FETCH_OBJ);
?>        

<section class="main fullWidth">
    
    <div class="content">
        
        <h1>Index</h1>

        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem culpa velit provident excepturi impedit ullam voluptas, ipsum temporibus aliquam maiores pariatur quasi officiis iusto sequi cumque architecto asperiores ad facere!
        Quas aliquam vitae, rem quibusdam obcaecati perferendis hic soluta iste sapiente vero aperiam quam deleniti doloremque illum voluptatem laudantium ex. Voluptates, dignissimos totam. Voluptas aliquam, vel hic sint quasi consectetur.
        Totam rerum est quae quasi perspiciatis eligendi similique consectetur praesentium tempora magni at illo laboriosam aut quisquam, dolorem sunt omnis! Corporis dolor quidem dolores. Ex consectetur aliquid veniam quasi temporibus!
        Voluptate ducimus necessitatibus rem sapiente nihil tempora. Facere asperiores dolorem, non reprehenderit et deserunt doloremque ea consectetur tempora expedita sapiente beatae error maxime, ut, culpa harum sint repellendus adipisci dignissimos.
        Quasi doloremque maiores ullam. Cum neque laudantium maiores praesentium consequatur quisquam corporis ab rerum ut iusto? Perspiciatis, corporis enim. Quia est quis dolor ipsam, beatae laboriosam consectetur quam aliquid voluptate!</p>

    </div>
</section>