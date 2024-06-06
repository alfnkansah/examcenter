@props(['data', 'label', 'gradient'])

<div class="col-md-3 mb-4 stretch-card transparent">
    <div class="card {{ $gradient }}">
        <div class="card-body">
            <p class="mb-4">{{ $label }}</p>
            <p class="fs-30 mb-2">{{ $data }}</p>
        </div>
    </div>
</div>


<style>
    .card-gradient-blue {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        /* Original bright blue */
        background: linear-gradient(to right, #4e54c8, #8f94fb);
        /* Cooler blue */
        color: white;
    }

    .card-gradient-red {
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        /* Original bright red */
        background: linear-gradient(to right, #cb2d3e, #ef473a);
        /* Cooler red */
        color: white;
    }

    .card-gradient-green {
        background: linear-gradient(to right, #11998e, #38ef7d);
        /* Original bright green */
        background: linear-gradient(to right, #56ab2f, #a8e063);
        /* Cooler green */
        color: white;
    }

    .card-gradient-orange {
        background: linear-gradient(to right, #ff8008, #ffc837);
        /* Original bright orange */
        background: linear-gradient(to right, #ff9966, #ff5e62);
        /* Cooler orange */
        color: white;
    }

    .card-gradient-purple {
        background: linear-gradient(to right, #6a3093, #a044ff);
        /* Original bright purple */
        background: linear-gradient(to right, #8e2de2, #4a00e0);
        /* Cooler purple */
        color: white;
    }

    .card-gradient-pink {
        background: linear-gradient(to right, #ff4b2b, #ff416c);
        /* Original bright pink */
        background: linear-gradient(to right, #f7971e, #ffd200);
        /* Cooler pink */
        color: white;
    }

    .card-gradient-teal {
        background: linear-gradient(to right, #1f4037, #99f2c8);
        /* Original bright teal */
        background: linear-gradient(to right, #43cea2, #185a9d);
        /* Cooler teal */
        color: white;
    }

    .card-gradient-yellow {
        background: linear-gradient(to right, #f7971e, #ffd200);
        /* Original bright yellow */
        background: linear-gradient(to right, #fbc2eb, #a6c1ee);
        /* Cooler yellow */
        color: white;
    }
</style>
