<template>
    <div class="w-full md:w-1/2 mx-auto view h-100">
        <h2 class="text-4xl tracking-wider">
            Join ShopsRus where we have millions of items in inventory
        </h2>
        <p class="text-gray-500 mt-4">
            And we can ship items as fast as same day or night. Whatever you
            need we have. Seriously, check us out. sign up now &nbsp;
            <i class="fa-solid fa-hand-point-down text-white"></i>
        </p>
        <form class="border border-gray-700 my-6 min-h-screen p-8">
            <div class="my-8">
                <i class="fa-solid fa-user-tie absolute mt-4 ml-4 text-xl"></i>
                <input
                    type="text"
                    name="name"
                    placeholder="Elon Musk"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <i class="fa-solid fa-envelope absolute mt-4 ml-4 text-xl"></i>
                <input
                    type="email"
                    name="email"
                    placeholder="teslaadmin@example.org"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <i class="fa-solid fa-lock absolute mt-4 ml-4 text-xl"></i>
                <input
                    type="password"
                    name="password"
                    placeholder="********"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                />
            </div>

            <div class="my-8">
                <input
                    type="checkbox"
                    name="terms-of-service"
                    placeholder="********"
                    class="bg-gray-900 w-full rounded-full p-4 border border-gray-400 pl-12"
                    style="max-width: 10%;"
                />
                <label class="text-sm">I agree to the <a href="#" class="text-blue-300 underline">terms of service</a> regulations listed.</label>
            </div>

            <div class="mt-8 flex">
                <button class="text-2xl border border-white p-8 w-3/4 mx-auto rounded-full bg-blue-800 text-black hover:bg-yellow-200 ease-in duration-200">Sign up</button>
            </div>

            <div class="mt-6 flex justify-center">
              <p class="text-gray-400 text-center">Already have an account? <a href="/login" class="text-blue-800 underline">Login</a></p>
            </div>
        </form>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped></style>
